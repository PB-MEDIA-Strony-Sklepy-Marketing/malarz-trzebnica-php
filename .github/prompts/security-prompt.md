# 🔒 Security Audit Prompt - OWASP Top 10 & Contact Form Security

**Wersja:** 1.0.0  
**Data:** 2024-12-15  
**Przeznaczenie:** Kompleksowy audyt bezpieczeństwa aplikacji PHP 8.4

---

## 🎯 Kontekst Projektu

**Application:** Strona WWW Kancelarii Adwokackiej Katarzyny Maj  
**Tech Stack:** PHP 8.4, Bootstrap 5.3, HTML5, CSS3, JavaScript  
**Critical Components:** Formularz kontaktowy, PHPMailer  
**Security Standard:** OWASP Top 10 2021, RODO/GDPR Compliance

---

## 📋 OWASP Top 10 Security Checklist

### 1. 🔓 A01: Broken Access Control

#### Sprawdź:
- [ ] Czy wszystkie pliki konfiguracyjne są chronione?
- [ ] Czy katalog `.env` jest w `.gitignore`?
- [ ] Czy `.git` directory nie jest dostępny publicznie?
- [ ] Czy `vendor/` directory nie jest dostępny publicznie?
- [ ] Czy directory listing jest wyłączony?

**Test:**
```bash
# Próba dostępu do wrażliwych plików
curl https://www.adwokat-trzebnica.com/.env
curl https://www.adwokat-trzebnica.com/.git/config
curl https://www.adwokat-trzebnica.com/vendor/
curl https://www.adwokat-trzebnica.com/composer.json
```

**Ochrona w .htaccess:**
```apache
# Disable directory listing
Options -Indexes

# Protect sensitive files
<FilesMatch "\.(env|log|ini|md|json|lock|git)$">
    Order allow,deny
    Deny from all
</FilesMatch>

# Protect .git directory
<DirectoryMatch "\.git">
    Order allow,deny
    Deny from all
</DirectoryMatch>

# Protect vendor directory
<Directory "/var/www/html/vendor">
    Order allow,deny
    Deny from all
</Directory>
```

---

### 2. 🔐 A02: Cryptographic Failures

#### A. HTTPS/TLS
- [ ] Czy strona używa HTTPS wszędzie?
- [ ] Czy certyfikat SSL jest ważny?
- [ ] Czy używany TLS 1.2 lub nowszy?
- [ ] Czy HSTS header jest ustawiony?
- [ ] Czy nie ma mixed content (HTTP resources na HTTPS page)?

**Test HTTPS:**
```bash
# Test SSL Labs
https://www.ssllabs.com/ssltest/analyze.html?d=adwokat-trzebnica.com

# Expected: A+ rating
```

**HSTS Header:**
```php
header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
```

#### B. Sensitive Data Protection
- [ ] Czy hasła/klucze NIE są hardcoded?
- [ ] Czy używane .env dla secrets?
- [ ] Czy dane osobowe są odpowiednio chronione (RODO)?
- [ ] Czy logi nie zawierają wrażliwych danych?

**❌ NIGDY:**
```php
$smtp_password = 'MyPassword123';  // Hardcoded!
$api_key = 'abc123xyz';  // Hardcoded!
```

**✅ ZAWSZE:**
```php
$smtp_password = $_ENV['SMTP_PASSWORD'];
$api_key = $_ENV['API_KEY'];
```

---

### 3. 💉 A03: Injection

#### A. XSS (Cross-Site Scripting)
**NAJWAŻNIEJSZE:** Escapuj WSZYSTKIE dane wyjściowe!

- [ ] Czy używane `htmlspecialchars()` dla wszystkich user inputs?
- [ ] Czy dla JSON używane `JSON_HEX_*` flags?
- [ ] Czy dla URLs używane `rawurlencode()`?
- [ ] Czy Content-Security-Policy header jest ustawiony?

**Helper Functions:**
```php
<?php
// includes/helpers/sanitizers.php

declare(strict_types=1);

/**
 * Escape HTML output
 */
function e(string $string): string
{
    return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Escape for HTML attributes
 */
function eAttr(string $string): string
{
    return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Escape for JavaScript
 */
function eJs(mixed $value): string
{
    return json_encode($value, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
}

/**
 * Escape for URLs
 */
function eUrl(string $string): string
{
    return rawurlencode($string);
}
```

**Użycie:**
```php
<!-- HTML -->
<h1><?= e($userName) ?></h1>

<!-- Attributes -->
<input type="text" value="<?= eAttr($userInput) ?>">

<!-- JavaScript -->
<script>
    const data = <?= eJs($phpArray) ?>;
</script>

<!-- URL -->
<a href="/search?q=<?= eUrl($query) ?>">Search</a>
```

#### B. SQL Injection (jeśli używana DB)
- [ ] Czy WSZYSTKIE zapytania używają prepared statements?
- [ ] Czy NIE ma string concatenation z user input?
- [ ] Czy używane PDO z parametrami?

**❌ VULNERABLE:**
```php
$email = $_POST['email'];
$query = "SELECT * FROM users WHERE email = '$email'";  // SQL Injection!
$result = mysqli_query($conn, $query);
```

**✅ SECURE:**
```php
$email = $_POST['email'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
$result = $stmt->fetch();
```

#### C. Command Injection
- [ ] Czy NIE używamy `exec()`, `shell_exec()`, `system()` z user input?
- [ ] Jeśli konieczne, czy używamy `escapeshellarg()`?

**❌ VULNERABLE:**
```php
$filename = $_POST['filename'];
exec("convert $filename output.jpg");  // Command Injection!
```

**✅ BETTER (ale unikaj):**
```php
$filename = escapeshellarg($_POST['filename']);
exec("convert $filename output.jpg");
```

**✅ BEST (unikaj shell commands):**
```php
// Użyj biblioteki PHP zamiast shell command
```

---

### 4. 🏗️ A04: Insecure Design

#### A. Rate Limiting - Formularz Kontaktowy
**KRYTYCZNE dla ochrony przed spam i atakami!**

- [ ] Czy formularz ma rate limiting?
- [ ] Czy IP address może wysłać max 5 wiadomości/godzinę?
- [ ] Czy email address może wysłać max 3 wiadomości/godzinę?
- [ ] Czy logi są prowadzone dla podejrzanej aktywności?

**Implementacja:**
```php
<?php
// includes/security/RateLimiter.php

declare(strict_types=1);

namespace AdwokatTrzebnica\Security;

class RateLimiter
{
    private const MAX_ATTEMPTS = 5;
    private const WINDOW_SECONDS = 3600; // 1 hour
    private string $storageDir;
    
    public function __construct(string $storageDir)
    {
        $this->storageDir = $storageDir;
        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0755, true);
        }
    }
    
    public function isRateLimited(string $identifier): bool
    {
        $file = $this->getAttemptFile($identifier);
        
        if (!file_exists($file)) {
            return false;
        }
        
        $attempts = json_decode(file_get_contents($file), true) ?: [];
        $validAttempts = array_filter(
            $attempts,
            fn($timestamp) => ($timestamp + self::WINDOW_SECONDS) > time()
        );
        
        return count($validAttempts) >= self::MAX_ATTEMPTS;
    }
    
    public function recordAttempt(string $identifier): void
    {
        $file = $this->getAttemptFile($identifier);
        $attempts = file_exists($file) 
            ? json_decode(file_get_contents($file), true) ?: []
            : [];
        
        $attempts[] = time();
        
        // Clean old attempts
        $attempts = array_filter(
            $attempts,
            fn($timestamp) => ($timestamp + self::WINDOW_SECONDS) > time()
        );
        
        file_put_contents($file, json_encode(array_values($attempts)), LOCK_EX);
    }
    
    private function getAttemptFile(string $identifier): string
    {
        $hash = hash('sha256', $identifier);
        return $this->storageDir . '/' . $hash . '.json';
    }
}

// Użycie
$rateLimiter = new RateLimiter(__DIR__ . '/../../storage/rate-limits');
$identifier = $_SERVER['REMOTE_ADDR'];

if ($rateLimiter->isRateLimited($identifier)) {
    http_response_code(429);
    header('Retry-After: 3600');
    die('Too many requests. Please try again in 1 hour.');
}

$rateLimiter->recordAttempt($identifier);
```

#### B. reCAPTCHA Integration
- [ ] Czy formularz ma Google reCAPTCHA v3?
- [ ] Czy response token jest weryfikowany server-side?
- [ ] Czy score threshold jest odpowiedni (0.5+)?

**Implementacja:**
```php
// Weryfikacja reCAPTCHA
function verifyRecaptcha(string $token): bool
{
    $secret = $_ENV['RECAPTCHA_SECRET_KEY'];
    $response = file_get_contents(
        "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$token"
    );
    $data = json_decode($response);
    
    return $data->success && $data->score >= 0.5;
}

if (!verifyRecaptcha($_POST['recaptcha_token'] ?? '')) {
    die('reCAPTCHA verification failed');
}
```

---

### 5. ⚙️ A05: Security Misconfiguration

#### A. PHP Configuration (php.ini)
- [ ] `display_errors = Off` (produkcja)
- [ ] `log_errors = On`
- [ ] `expose_php = Off`
- [ ] `allow_url_fopen = Off` (jeśli nie potrzebne)
- [ ] `allow_url_include = Off`
- [ ] `session.cookie_httponly = 1`
- [ ] `session.cookie_secure = 1`
- [ ] `session.cookie_samesite = Strict`

**Production php.ini:**
```ini
display_errors = Off
display_startup_errors = Off
log_errors = On
error_log = /var/log/php/error.log
error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT

expose_php = Off
allow_url_fopen = Off
allow_url_include = Off

session.cookie_httponly = 1
session.cookie_secure = 1
session.cookie_samesite = Strict
session.use_strict_mode = 1
session.use_only_cookies = 1

file_uploads = On
upload_max_filesize = 2M
max_file_uploads = 3
```

#### B. Error Handling
- [ ] Czy błędy NIE są wyświetlane użytkownikowi?
- [ ] Czy custom error pages istnieją (404, 500)?
- [ ] Czy stack traces nie są wyświetlane?

**Error Handler:**
```php
<?php
// includes/error-handler.php

declare(strict_types=1);

if ($_ENV['APP_ENV'] === 'production') {
    error_reporting(0);
    ini_set('display_errors', '0');
    
    set_error_handler(function($errno, $errstr, $errfile, $errline) {
        error_log("Error: $errstr in $errfile on line $errline");
        
        if (in_array($errno, [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR])) {
            http_response_code(500);
            include __DIR__ . '/../templates/errors/500.php';
            exit;
        }
    });
}
```

---

### 6. 🔧 A06: Vulnerable and Outdated Components

#### Sprawdź Dependencies
- [ ] Czy używane najnowsze wersje PHP (8.4)?
- [ ] Czy Composer packages są aktualne?
- [ ] Czy `composer audit` nie pokazuje vulnerabilities?
- [ ] Czy używany `roave/security-advisories`?

**Audyt:**
```bash
# Check for known vulnerabilities
composer audit

# Update packages
composer update

# Check outdated packages
composer outdated
```

**composer.json:**
```json
{
  "require": {
    "php": ">=8.4",
    "phpmailer/phpmailer": "^6.9",
    "vlucas/phpdotenv": "^5.6"
  },
  "require-dev": {
    "roave/security-advisories": "dev-latest"
  }
}
```

---

### 7. 🔑 A07: Identification and Authentication Failures

#### Session Security
- [ ] Czy sesje są regenerowane po zmianie uprawnień?
- [ ] Czy session ID ma odpowiednią entropię?
- [ ] Czy sesje wygasają po nieaktywności?
- [ ] Czy cookie flags są prawidłowe (HttpOnly, Secure, SameSite)?

**Session Handler:**
```php
<?php
// includes/security/Session.php

declare(strict_types=1);

namespace AdwokatTrzebnica\Security;

class Session
{
    private const SESSION_LIFETIME = 1800; // 30 minutes
    
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            ini_set('session.cookie_httponly', '1');
            ini_set('session.cookie_secure', '1');
            ini_set('session.cookie_samesite', 'Strict');
            ini_set('session.use_strict_mode', '1');
            ini_set('session.use_only_cookies', '1');
            ini_set('session.gc_maxlifetime', (string)self::SESSION_LIFETIME);
            
            session_start();
            
            // Check session timeout
            if (isset($_SESSION['LAST_ACTIVITY']) && 
                (time() - $_SESSION['LAST_ACTIVITY'] > self::SESSION_LIFETIME)) {
                self::destroy();
                session_start();
            }
            $_SESSION['LAST_ACTIVITY'] = time();
            
            // Regenerate session ID periodically
            if (!isset($_SESSION['CREATED'])) {
                $_SESSION['CREATED'] = time();
            } elseif (time() - $_SESSION['CREATED'] > 300) {
                session_regenerate_id(true);
                $_SESSION['CREATED'] = time();
            }
        }
    }
    
    public static function destroy(): void
    {
        $_SESSION = [];
        
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }
        
        session_destroy();
    }
}
```

---

### 8. 🛡️ A08: Software and Data Integrity Failures

#### A. Subresource Integrity (SRI)
- [ ] Czy CDN resources mają SRI hashes?
- [ ] Czy używane tylko zaufane CDN (jsDelivr, cdnjs)?

**Przykład z SRI:**
```html
<link rel="stylesheet" 
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
```

#### B. File Upload Security (jeśli używane)
- [ ] Czy dozwolone tylko bezpieczne typy plików?
- [ ] Czy wielkość pliku jest limitowana?
- [ ] Czy pliki są zapisywane poza webroot?
- [ ] Czy nazwy plików są sanityzowane?
- [ ] Czy wykonywanie PHP jest zablokowane w katalogu uploads?

---

### 9. 📊 A09: Security Logging and Monitoring

#### Security Event Logging
- [ ] Czy failed login attempts są logowane?
- [ ] Czy podejrzana aktywność jest logowana?
- [ ] Czy logi zawierają timestamp, IP, user agent?
- [ ] Czy logi NIE zawierają wrażliwych danych (hasła)?

**Security Logger:**
```php
<?php
// includes/security/SecurityLogger.php

declare(strict_types=1);

namespace AdwokatTrzebnica\Security;

class SecurityLogger
{
    private string $logFile;
    
    public function __construct(string $logFile)
    {
        $this->logFile = $logFile;
        $dir = dirname($logFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }
    
    public function log(string $event, string $severity, array $context = []): void
    {
        $entry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'event' => $event,
            'severity' => $severity,  // info, warning, critical
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'context' => $context
        ];
        
        $json = json_encode($entry, JSON_UNESCAPED_UNICODE) . PHP_EOL;
        file_put_contents($this->logFile, $json, FILE_APPEND | LOCK_EX);
    }
    
    public function logRateLimitExceeded(string $identifier): void
    {
        $this->log(
            'rate_limit_exceeded',
            'warning',
            ['identifier' => $identifier]
        );
    }
    
    public function logCSRFFailure(): void
    {
        $this->log(
            'csrf_token_invalid',
            'critical',
            ['url' => $_SERVER['REQUEST_URI'] ?? 'unknown']
        );
    }
    
    public function logFormSubmission(bool $success, string $email): void
    {
        $this->log(
            'contact_form_submission',
            $success ? 'info' : 'warning',
            ['email' => $email, 'success' => $success]
        );
    }
}
```

---

### 10. 🔒 A10: Server-Side Request Forgery (SSRF)

Jeśli aplikacja wykonuje zewnętrzne HTTP requests:

- [ ] Czy URLs są walidowane?
- [ ] Czy blokowane private IP ranges?
- [ ] Czy używana whitelist dozwolonych domen?

**SSRF Protection:**
```php
<?php

declare(strict_types=1);

namespace AdwokatTrzebnica\Security;

class SSRFProtection
{
    private const BLOCKED_NETWORKS = [
        '127.0.0.0/8',      // Localhost
        '10.0.0.0/8',       // Private
        '172.16.0.0/12',    // Private
        '192.168.0.0/16',   // Private
        '169.254.0.0/16',   // Link-local
    ];
    
    public static function isUrlSafe(string $url): bool
    {
        $parsed = parse_url($url);
        
        if (!$parsed || !isset($parsed['host'])) {
            return false;
        }
        
        if (!in_array($parsed['scheme'] ?? '', ['http', 'https'], true)) {
            return false;
        }
        
        $ip = gethostbyname($parsed['host']);
        
        foreach (self::BLOCKED_NETWORKS as $network) {
            if (self::ipInRange($ip, $network)) {
                return false;
            }
        }
        
        return true;
    }
    
    private static function ipInRange(string $ip, string $range): bool
    {
        [$subnet, $mask] = explode('/', $range);
        $ip_long = ip2long($ip);
        $subnet_long = ip2long($subnet);
        $mask_long = -1 << (32 - (int)$mask);
        
        return ($ip_long & $mask_long) === ($subnet_long & $mask_long);
    }
}
```

---

## 🛡️ Contact Form Specific Security

### Input Validation & Sanitization

```php
<?php
// includes/validators/ContactFormValidator.php

declare(strict_types=1);

namespace AdwokatTrzebnica\Validators;

class ContactFormValidator
{
    public function validateName(string $name): bool
    {
        // Polish letters, spaces, hyphens
        $pattern = '/^[\p{L}\s\-]+$/u';
        return preg_match($pattern, $name) === 1 
            && mb_strlen($name) >= 2 
            && mb_strlen($name) <= 100;
    }
    
    public function validateEmail(string $email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        // Additional: check DNS records
        [$user, $domain] = explode('@', $email);
        return checkdnsrr($domain, 'MX');
    }
    
    public function validatePhone(string $phone): bool
    {
        // Polish format: +48XXXXXXXXX or XXXXXXXXX
        $cleaned = preg_replace('/[^\d+]/', '', $phone);
        return preg_match('/^(\+?48)?[0-9]{9}$/', $cleaned) === 1;
    }
    
    public function validateMessage(string $message): bool
    {
        $length = mb_strlen($message);
        return $length >= 10 && $length <= 5000;
    }
    
    public function sanitizeInput(string $input): string
    {
        return trim(strip_tags($input));
    }
}
```

### CSRF Protection

```php
<?php
// includes/security/CSRF.php

declare(strict_types=1);

namespace AdwokatTrzebnica\Security;

class CSRF
{
    private const TOKEN_LENGTH = 32;
    private const TOKEN_LIFETIME = 3600; // 1 hour
    
    public function generateToken(): string
    {
        Session::start();
        
        $token = bin2hex(random_bytes(self::TOKEN_LENGTH));
        $_SESSION['csrf_token'] = $token;
        $_SESSION['csrf_token_time'] = time();
        
        return $token;
    }
    
    public function validateToken(string $token): bool
    {
        Session::start();
        
        if (!isset($_SESSION['csrf_token'], $_SESSION['csrf_token_time'])) {
            return false;
        }
        
        // Check age
        if (time() - $_SESSION['csrf_token_time'] > self::TOKEN_LIFETIME) {
            $this->clearToken();
            return false;
        }
        
        // Constant-time comparison
        $valid = hash_equals($_SESSION['csrf_token'], $token);
        
        if ($valid) {
            $this->clearToken();  // One-time use
        }
        
        return $valid;
    }
    
    public function clearToken(): void
    {
        Session::start();
        unset($_SESSION['csrf_token'], $_SESSION['csrf_token_time']);
    }
}
```

---

## 🔒 Security Headers

```php
<?php
// includes/security/SecurityHeaders.php

declare(strict_types=1);

namespace AdwokatTrzebnica\Security;

class SecurityHeaders
{
    public static function setHeaders(): void
    {
        // XSS Protection
        header('X-XSS-Protection: 1; mode=block');
        
        // Clickjacking Protection
        header('X-Frame-Options: SAMEORIGIN');
        
        // MIME Sniffing Protection
        header('X-Content-Type-Options: nosniff');
        
        // Referrer Policy
        header('Referrer-Policy: strict-origin-when-cross-origin');
        
        // Content Security Policy
        $csp = [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' https://www.googletagmanager.com https://www.google.com/recaptcha/ https://www.gstatic.com/recaptcha/",
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
            "img-src 'self' data: https: blob:",
            "font-src 'self' data: https://fonts.gstatic.com",
            "connect-src 'self' https://www.google-analytics.com",
            "frame-src https://www.google.com/recaptcha/",
            "frame-ancestors 'self'",
            "base-uri 'self'",
            "form-action 'self'"
        ];
        header('Content-Security-Policy: ' . implode('; ', $csp));
        
        // HSTS (tylko HTTPS)
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
        }
        
        // Permissions Policy
        header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
    }
}
```

---

## 📊 Security Audit Report Template

### Overall Security Score: __/100

| Category | Score | Status |
|----------|-------|--------|
| OWASP A01: Broken Access Control | __/10 | ✅/⚠️/❌ |
| OWASP A02: Cryptographic Failures | __/10 | ✅/⚠️/❌ |
| OWASP A03: Injection | __/15 | ✅/⚠️/❌ |
| OWASP A04: Insecure Design | __/10 | ✅/⚠️/❌ |
| OWASP A05: Security Misconfiguration | __/10 | ✅/⚠️/❌ |
| OWASP A06: Vulnerable Components | __/10 | ✅/⚠️/❌ |
| OWASP A07: Auth Failures | __/10 | ✅/⚠️/❌ |
| OWASP A08: Data Integrity | __/5 | ✅/⚠️/❌ |
| OWASP A09: Logging | __/10 | ✅/⚠️/❌ |
| OWASP A10: SSRF | __/5 | ✅/⚠️/❌ |
| RODO/GDPR Compliance | __/5 | ✅/⚠️/❌ |

---

## 🚨 Critical Vulnerabilities (Fix Immediately)

1. **[CRITICAL]** XSS in contact form - user input not escaped
2. **[CRITICAL]** Missing CSRF protection on form
3. **[CRITICAL]** ...

---

## ⚠️ Major Security Issues (Fix Within 7 Days)

1. **[MAJOR]** No rate limiting on contact form
2. **[MAJOR]** Missing security headers
3. **[MAJOR]** ...

---

## 💡 Security Recommendations

1. **[RECOMMENDATION]** Implement Content Security Policy
2. **[RECOMMENDATION]** Add security.txt file
3. **[RECOMMENDATION]** ...

---

## 🎓 AI Instructions

Jako AI security auditor:

1. **Think like an attacker:** Jak można zaatakować tę aplikację?
2. **Check systematically:** Przejdź przez OWASP Top 10 punkt po punkcie
3. **Be specific:** Wskaż dokładnie gdzie vulnerability i jak exploit
4. **Provide proof-of-concept:** Pokaż przykład ataku (bezpiecznie)
5. **Prioritize by risk:** Critical > Major > Low
6. **Include remediation:** Nie tylko problem, ale i rozwiązanie

---

**Ostatnia aktualizacja:** 2024-12-15  
**Standard:** OWASP Top 10 2021, RODO/GDPR  
**Owner:** Kancelaria Adwokacka Katarzyna Maj

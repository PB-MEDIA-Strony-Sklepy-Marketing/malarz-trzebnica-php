# Bezpieczeństwo - Malarz Trzebnica

## 1. Wstęp

Dokument opisuje wszystkie aspekty bezpieczeństwa aplikacji **Malarz Trzebnica**, w tym ochronę przed atakami, walidacją danych i best practices w PHP.

### Główne Zagrożenia:
- 🔴 SQL Injection
- 🔴 Cross-Site Scripting (XSS)
- 🔴 Cross-Site Request Forgery (CSRF)
- 🔴 Session Hijacking
- 🔴 File Upload Vulnerabilities
- 🔴 Broken Authentication
- 🔴 Brute Force Attacks
- 🔴 API Security Issues

---

## 2. SQL Injection

### 2.1 Problem

```php
// ❌ NIEBEZPIECZNE - podatne na SQL Injection
$id = $_GET['id'];
$sql = "SELECT * FROM projekty WHERE id = " . $id;
$result = $db->query($sql);

// Atak: ?id=1 OR 1=1 -- 
// Spowoduje: SELECT * FROM projekty WHERE id = 1 OR 1=1 --
// Pobierze wszystkie projekty!
```

### 2.2 Rozwiązanie: Prepared Statements

```php
// ✅ BEZPIECZNE - używamy prepared statements
use App\Core\Database;

$db = new Database($config);
$id = $_GET['id'];

// Metoda 1: PDO Prepared Statements
$stmt = $db->prepare("SELECT * FROM projekty WHERE id = ?");
$stmt->execute([$id]);
$projekt = $stmt->fetch();

// Metoda 2: Named Parameters
$stmt = $db->prepare("SELECT * FROM projekty WHERE id = :id");
$stmt->execute([':id' => $id]);
$projekt = $stmt->fetch();
```

### 2.3 Klasa Database z Ochroną

**Plik: src/Core/Database.php**

```php
<?php
namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private $pdo;
    private $statement;
    
    public function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['database']};charset=utf8mb4";
        
        try {
            $this->pdo = new PDO(
                $dsn,
                $config['user'],
                $config['password'],
                [
                    // Rzuć exception na błąd
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    // Domyślnie fetch jako array
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    // Nie emuluj prepared statements (ważne dla bezpieczeństwa!)
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            // Nie wyświetlaj komunikatu błędu dla użytkownika
            error_log('Database Connection Error: ' . $e->getMessage());
            die('Błąd bazy danych. Skontaktuj się z administratorem.');
        }
    }
    
    /**
     * Wykonaj prepared statement
     */
    public function query($sql, $params = [])
    {
        try {
            $this->statement = $this->pdo->prepare($sql);
            
            // Binduj parametry
            if (!empty($params)) {
                foreach ($params as $key => $value) {
                    // Użyj PDO::PARAM_INT dla liczb
                    $type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
                    $this->statement->bindValue($key + 1, $value, $type);
                }
            }
            
            $this->statement->execute();
            return $this;
        } catch (PDOException $e) {
            error_log('Query Error: ' . $e->getMessage());
            throw new \Exception('Błąd bazy danych');
        }
    }
    
    /**
     * Pobierz jeden wiersz
     */
    public function single()
    {
        return $this->statement->fetch();
    }
    
    /**
     * Pobierz wszystkie wiersze
     */
    public function getAll()
    {
        return $this->statement->fetchAll();
    }
    
    /**
     * Bezpieczne escape'owanie string'ów (ostateczność)
     */
    public function escape($value)
    {
        return $this->pdo->quote($value);
    }
}
```

### 2.4 Praktyczne Przykłady

```php
// ✅ BEZPIECZNE - wyszukiwanie projektów
$keyword = $_GET['search'] ?? '';
$db->query('SELECT * FROM projekty WHERE nazwa LIKE ?', ['%' . $keyword . '%']);
$rezultaty = $db->getAll();

// ✅ BEZPIECZNE - wstawianie danych
$db->query(
    'INSERT INTO wiadomosci (imie, email, temat, wiadomosc) VALUES (?, ?, ?, ?)',
    [$_POST['imie'], $_POST['email'], $_POST['temat'], $_POST['wiadomosc']]
);

// ✅ BEZPIECZNE - aktualizacja
$db->query(
    'UPDATE projekty SET nazwa = ?, opis = ? WHERE id = ?',
    [$_POST['nazwa'], $_POST['opis'], $_POST['id']]
);

// ✅ BEZPIECZNE - usuwanie
$db->query('DELETE FROM projekty WHERE id = ?', [$_GET['id']]);
```

---

## 3. Cross-Site Scripting (XSS)

### 3.1 Problem

```php
// ❌ NIEBEZPIECZNE
$nazwa = $_GET['nazwa'];
echo "Witaj, $nazwa"; // Może być JavaScript!

// Atak: ?nazwa=<img src=x onerror=alert('XSS')>
// Spowoduje: Witaj, <img src=x onerror=alert('XSS')>
// Kod JavaScript się wykona!
```

### 3.2 Rozwiązania

#### Metoda 1: htmlspecialchars()

```php
// ✅ BEZPIECZNE - dla zwykłego tekstu
$nazwa = $_GET['nazwa'] ?? '';
echo "Witaj, " . htmlspecialchars($nazwa, ENT_QUOTES, 'UTF-8');

// htmlspecialchars() konwertuje:
// < -> &lt;
// > -> &gt;
// & -> &amp;
// " -> &quot;
// ' -> &#039;
```

#### Metoda 2: strip_tags()

```php
// ✅ BEZPIECZNE - usuń wszystkie tagi HTML
$opis = $_POST['opis'] ?? '';
$czysty_opis = strip_tags($opis);

// Usuń wszystkie tagi oprócz wybranych
$czysty_opis = strip_tags($opis, '<p><br><strong><em>');
```

#### Metoda 3: Klasa Sanitizer

**Plik: src/Core/Sanitizer.php**

```php
<?php
namespace App\Core;

class Sanitizer
{
    /**
     * Sanitize string dla HTML output
     */
    public static function text($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    
    /**
     * Sanitize dla HTML atrybutów
     */
    public static function attribute($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    
    /**
     * Sanitize dla URL
     */
    public static function url($value)
    {
        $value = filter_var($value, FILTER_VALIDATE_URL);
        return $value ?: '';
    }
    
    /**
     * Sanitize dla email
     */
    public static function email($value)
    {
        return filter_var($value, FILTER_SANITIZE_EMAIL);
    }
    
    /**
     * Sanitize dla liczb
     */
    public static function integer($value)
    {
        return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }
    
    /**
     * Sanitize HTML z dozwolonymi tagami
     */
    public static function html($value, $allowed = '<p><br><strong><em><u><h1><h2><h3><a>')
    {
        return strip_tags($value, $allowed);
    }
    
    /**
     * Sanitize array (np. $_POST)
     */
    public static function array($array)
    {
        $sanitized = [];
        foreach ($array as $key => $value) {
            $sanitized[self::text($key)] = is_array($value) 
                ? self::array($value)
                : self::text($value);
        }
        return $sanitized;
    }
}
```

### 3.3 Praktyczne Przykłady

```php
// ✅ BEZPIECZNE - wyświetlanie danych użytkownika
use App\Core\Sanitizer;

$projekt = $db->query('SELECT * FROM projekty WHERE id = ?', [$id])->single();

?>
<!-- W widoku -->
<h1><?php echo Sanitizer::text($projekt['nazwa']); ?></h1>
<p><?php echo Sanitizer::html($projekt['opis']); ?></p>
<a href="<?php echo Sanitizer::attribute($projekt['link']); ?>">
    Kliknij tutaj
</a>
```

#### W Formularzach

```php
// ✅ BEZPIECZNE - przetwarzanie formularza
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imie = Sanitizer::text($_POST['imie'] ?? '');
    $email = Sanitizer::email($_POST['email'] ?? '');
    $wiadomosc = Sanitizer::html($_POST['wiadomosc'] ?? '');
    
    // Sprawdź czy dane są poprawne
    if ($imie && $email && $wiadomosc) {
        // Zapisz do bazy
    }
}
```

---

## 4. Cross-Site Request Forgery (CSRF)

### 4.1 Problem

```php
// Atak CSRF:
// Użytkownik zalogowany do www.malarz.trzebnica.pl
// Kliknie na link z złośliwej strony
// Link wyśle żądanie do usunięcia projektu bez wiedzy użytkownika
// <img src="https://www.malarz.trzebnica.pl/admin/delete?id=1">
```

### 4.2 Rozwiązanie: CSRF Tokens

**Plik: src/Core/Csrf.php**

```php
<?php
namespace App\Core;

class Csrf
{
    private static $tokenKey = '_csrf_token';
    private static $tokenLength = 32;
    
    /**
     * Wygeneruj CSRF token
     */
    public static function generate()
    {
        if (empty($_SESSION[self::$tokenKey])) {
            $_SESSION[self::$tokenKey] = bin2hex(random_bytes(self::$tokenLength));
        }
        return $_SESSION[self::$tokenKey];
    }
    
    /**
     * Pobierz token
     */
    public static function token()
    {
        return self::generate();
    }
    
    /**
     * Wygeneruj pole HTML z tokenem
     */
    public static function field()
    {
        return '<input type="hidden" name="' . self::$tokenKey . '" value="' . self::token() . '">';
    }
    
    /**
     * Sprawdź token
     */
    public static function verify($token = null)
    {
        if ($token === null) {
            $token = $_POST[self::$tokenKey] ?? '';
        }
        
        if (empty($_SESSION[self::$tokenKey])) {
            return false;
        }
        
        // Porównaj tokeny używając hash_equals() aby uniknąć timing attack
        return hash_equals($_SESSION[self::$tokenKey], $token);
    }
}
```

### 4.3 Użycie CSRF Tokenów

#### W Formularzach

```php
<!-- ✅ Formularz z CSRF tokenem -->
<form method="POST" action="/kontakt">
    <?php echo Csrf::field(); ?>
    
    <input type="text" name="imie" required>
    <input type="email" name="email" required>
    <textarea name="wiadomosc"></textarea>
    
    <button type="submit">Wyślij</button>
</form>
```

#### W Kontrolerze

```php
<?php
namespace App\Controllers;

use App\Core\Csrf;

class KontaktController extends BaseController
{
    public function wyslij()
    {
        // Sprawdź CSRF token
        if (!Csrf::verify($_POST['_csrf_token'] ?? '')) {
            http_response_code(403);
            $this->json(['error' => 'Niepoprawny token bezpieczeństwa'], 403);
        }
        
        // Token jest poprawny - kontynuuj przetwarzanie
        $imie = $_POST['imie'] ?? '';
        $email = $_POST['email'] ?? '';
        
        // ...
    }
}
```

---

## 5. Session Security

### 5.1 Konfiguracja Sessions

**Plik: config/session.php**

```php
<?php

// Zacznij sesję
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ustaw bezpieczne opcje sesji
ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1); // HTTPS only
ini_set('session.cookie_samesite', 'Strict');
ini_set('session.gc_maxlifetime', 3600); // 1 godzina
ini_set('session.cookie_lifetime', 0); // Tylko gdy przeglądarka otwarta

// Regeneruj session ID
if (!isset($_SESSION['created'])) {
    $_SESSION['created'] = time();
} else if (time() - $_SESSION['created'] > 1800) { // 30 minut
    session_regenerate_id(true);
    $_SESSION['created'] = time();
}
```

### 5.2 Klasa Authentication

**Plik: src/Core/Auth.php**

```php
<?php
namespace App\Core;

class Auth
{
    private $db;
    
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    
    /**
     * Zaloguj użytkownika
     */
    public function login($email, $password)
    {
        // Pobierz użytkownika
        $this->db->query('SELECT * FROM users WHERE email = ?', [$email]);
        $user = $this->db->single();
        
        if (!$user) {
            return false;
        }
        
        // Porównaj hasło
        if (!password_verify($password, $user['password'])) {
            return false;
        }
        
        // Zaloguj
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['login_time'] = time();
        
        return true;
    }
    
    /**
     * Wyloguj użytkownika
     */
    public function logout()
    {
        session_destroy();
        session_start();
        $_SESSION = [];
    }
    
    /**
     * Sprawdź czy użytkownik zalogowany
     */
    public function isLoggedIn()
    {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }
    
    /**
     * Pobierz zalogowanego użytkownika
     */
    public function getUser()
    {
        if (!$this->isLoggedIn()) {
            return null;
        }
        
        $this->db->query('SELECT * FROM users WHERE id = ?', [$_SESSION['user_id']]);
        return $this->db->single();
    }
    
    /**
     * Zmień hasło
     */
    public function changePassword($userId, $oldPassword, $newPassword)
    {
        $user = $this->getUser();
        
        if ($user['id'] !== $userId) {
            return false;
        }
        
        // Sprawdź stare hasło
        if (!password_verify($oldPassword, $user['password'])) {
            return false;
        }
        
        // Zaktualizuj hasło
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 12]);
        
        $this->db->query(
            'UPDATE users SET password = ? WHERE id = ?',
            [$hashedPassword, $userId]
        );
        
        return $this->db->rowCount() > 0;
    }
}
```

---

## 6. File Upload Security

### 6.1 Problem

```php
// ❌ NIEBEZPIECZNE
$file = $_FILES['upload']['name'];
move_uploaded_file($_FILES['upload']['tmp_name'], '/uploads/' . $file);
// Atakujący może wrzucić shell.php i wykonać kod!
```

### 6.2 Bezpieczny Upload

**Plik: src/Core/FileUploader.php**

```php
<?php
namespace App\Core;

class FileUploader
{
    private $allowedMimes = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif',
    ];
    
    private $maxSize = 5 * 1024 * 1024; // 5MB
    private $uploadDir = '/uploads/';
    
    /**
     * Przesyłanie pliku
     */
    public function upload($fileInput, $destinationDir = null)
    {
        $destinationDir = $destinationDir ?? $this->uploadDir;
        
        // Sprawdź czy plik został przesłany
        if (!isset($_FILES[$fileInput]) || $_FILES[$fileInput]['error'] !== UPLOAD_ERR_OK) {
            throw new \Exception('Błąd przy przesyłaniu pliku: ' . $_FILES[$fileInput]['error']);
        }
        
        $file = $_FILES[$fileInput];
        
        // 1. Sprawdź rozmiar
        if ($file['size'] > $this->maxSize) {
            throw new \Exception('Plik jest za duży. Maksymalny rozmiar: 5MB');
        }
        
        // 2. Sprawdź MIME type
        $mimeType = mime_content_type($file['tmp_name']);
        if (!array_key_exists($mimeType, $this->allowedMimes)) {
            throw new \Exception('Nieobsługiwany typ pliku');
        }
        
        // 3. Wygeneruj bezpieczną nazwę pliku
        $extension = $this->allowedMimes[$mimeType];
        $filename = uniqid() . '_' . time() . '.' . $extension;
        
        // 4. Sprawdź czy katalog istnieje
        $fullPath = dirname(__DIR__, 2) . '/public' . $destinationDir;
        if (!is_dir($fullPath)) {
            mkdir($fullPath, 0755, true);
        }
        
        // 5. Przenieś plik
        $destination = $fullPath . '/' . $filename;
        
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new \Exception('Nie można przenieść pliku');
        }
        
        // 6. Ustaw bezpieczne uprawnienia
        chmod($destination, 0644);
        
        return $destinationDir . '/' . $filename;
    }
    
    /**
     * Usuń plik
     */
    public function delete($filepath)
    {
        $fullPath = dirname(__DIR__, 2) . '/public' . $filepath;
        
        // Sprawdź czy ścieżka jest bezpieczna
        if (strpos(realpath($fullPath), realpath(dirname(__DIR__, 2))) !== 0) {
            throw new \Exception('Dostęp do pliku zabroniony');
        }
        
        if (file_exists($fullPath) && is_file($fullPath)) {
            unlink($fullPath);
            return true;
        }
        
        return false;
    }
}
```

### 6.3 Użycie w Kontrolerze

```php
<?php
namespace App\Controllers;

use App\Core\FileUploader;

class AdminController extends BaseController
{
    public function uploadGaleria()
    {
        try {
            $uploader = new FileUploader();
            $filePath = $uploader->upload('zdjecie', '/assets/images/galeria/');
            
            // Zapisz ścieżkę do bazy
            $this->db->query(
                'INSERT INTO zdjecia (projekt_id, sciezka_plik) VALUES (?, ?)',
                [$_POST['projekt_id'], $filePath]
            );
            
            $this->json(['success' => true, 'file' => $filePath]);
        } catch (\Exception $e) {
            $this->json(['error' => $e->getMessage()], 400);
        }
    }
}
```

---

## 7. Input Validation

### 7.1 Klasa Validator

**Plik: src/Core/Validator.php**

```php
<?php
namespace App\Core;

class Validator
{
    private $data;
    private $errors = [];
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    /**
     * Sprawdzaj pole - czy istnieje
     */
    public function required($field, $message = null)
    {
        $value = trim($this->data[$field] ?? '');
        
        if (empty($value)) {
            $this->errors[$field][] = $message ?? "$field jest wymagany";
        }
        
        return $this;
    }
    
    /**
     * Sprawdzaj email
     */
    public function email($field, $message = null)
    {
        $value = $this->data[$field] ?? '';
        
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = $message ?? "$field musi być poprawnym emailem";
        }
        
        return $this;
    }
    
    /**
     * Sprawdzaj URL
     */
    public function url($field, $message = null)
    {
        $value = $this->data[$field] ?? '';
        
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            $this->errors[$field][] = $message ?? "$field musi być poprawnym URL";
        }
        
        return $this;
    }
    
    /**
     * Sprawdzaj długość
     */
    public function minLength($field, $length, $message = null)
    {
        $value = $this->data[$field] ?? '';
        
        if (strlen($value) < $length) {
            $this->errors[$field][] = $message ?? "$field musi mieć co najmniej $length znaków";
        }
        
        return $this;
    }
    
    /**
     * Sprawdzaj maksymalną długość
     */
    public function maxLength($field, $length, $message = null)
    {
        $value = $this->data[$field] ?? '';
        
        if (strlen($value) > $length) {
            $this->errors[$field][] = $message ?? "$field może mieć maksymalnie $length znaków";
        }
        
        return $this;
    }
    
    /**
     * Sprawdzaj liczę
     */
    public function numeric($field, $message = null)
    {
        $value = $this->data[$field] ?? '';
        
        if (!is_numeric($value)) {
            $this->errors[$field][] = $message ?? "$field musi być liczbą";
        }
        
        return $this;
    }
    
    /**
     * Sprawdzaj wyrażenie regularne
     */
    public function pattern($field, $pattern, $message = null)
    {
        $value = $this->data[$field] ?? '';
        
        if (!preg_match($pattern, $value)) {
            $this->errors[$field][] = $message ?? "$field ma niepoprawny format";
        }
        
        return $this;
    }
    
    /**
     * Sprawdzaj czy wartość istnieje w bazie
     */
    public function exists($field, $table, $column, $db, $message = null)
    {
        $value = $this->data[$field] ?? '';
        
        if (empty($value)) {
            return $this;
        }
        
        $db->query("SELECT COUNT(*) as count FROM $table WHERE $column = ?", [$value]);
        $result = $db->single();
        
        if ($result['count'] === 0) {
            $this->errors[$field][] = $message ?? "Wybrany $field nie istnieje";
        }
        
        return $this;
    }
    
    /**
     * Sprawdzaj czy wartość jest unikalna w bazie
     */
    public function unique($field, $table, $column, $db, $message = null)
    {
        $value = $this->data[$field] ?? '';
        
        if (empty($value)) {
            return $this;
        }
        
        $db->query("SELECT COUNT(*) as count FROM $table WHERE $column = ?", [$value]);
        $result = $db->single();
        
        if ($result['count'] > 0) {
            $this->errors[$field][] = $message ?? "Ten $field już istnieje";
        }
        
        return $this;
    }
    
    /**
     * Sprawdzaj czy są błędy
     */
    public function fails()
    {
        return !empty($this->errors);
    }
    
    /**
     * Pobierz błędy
     */
    public function getErrors()
    {
        return $this->errors;
    }
    
    /**
     * Pobierz błędy w formacie string
     */
    public function getErrorMessages()
    {
        $messages = [];
        foreach ($this->errors as $field => $fieldErrors) {
            $messages[] = implode(', ', $fieldErrors);
        }
        return $messages;
    }
}
```

### 7.2 Użycie Validatora

```php
<?php
namespace App\Controllers;

use App\Core\Validator;

class KontaktController extends BaseController
{
    public function wyslij()
    {
        // Waliduj dane
        $validator = new Validator($_POST);
        
        $validator->required('imie')
                  ->minLength('imie', 2)
                  ->maxLength('imie', 100);
        
        $validator->required('email')
                  ->email('email');
        
        $validator->required('temat')
                  ->minLength('temat', 5)
                  ->maxLength('temat', 200);
        
        $validator->required('wiadomosc')
                  ->minLength('wiadomosc', 10)
                  ->maxLength('wiadomosc', 5000);
        
        if ($validator->fails()) {
            $this->json([
                'success' => false,
                'errors' => $validator->getErrors()
            ], 422);
        }
        
        // Jeśli walidacja przeszła, przetwórz formularz
        // ...
    }
}
```

---

## 8. Rate Limiting

### 8.1 Klasa RateLimiter

**Plik: src/Core/RateLimiter.php**

```php
<?php
namespace App\Core;

class RateLimiter
{
    private $cache = []; // W praktyce - Redis lub baza danych
    private $maxAttempts = 10;
    private $decayMinutes = 15;
    
    /**
     * Sprawdzaj czy żądanie jest dozwolone
     */
    public function allow($key, $maxAttempts = null, $decayMinutes = null)
    {
        $maxAttempts = $maxAttempts ?? $this->maxAttempts;
        $decayMinutes = $decayMinutes ?? $this->decayMinutes;
        
        $key = "rate_limit:{$key}";
        
        // W praktyce - pobierz z cache'a (Redis)
        $attempts = $this->getAttempts($key);
        
        if ($attempts >= $maxAttempts) {
            return false;
        }
        
        $this->incrementAttempts($key, $decayMinutes);
        return true;
    }
    
    /**
     * Pobierz liczbę prób
     */
    private function getAttempts($key)
    {
        // Wersja do pamięci
        return isset($this->cache[$key]) ? $this->cache[$key]['count'] : 0;
    }
    
    /**
     * Inkrementuj liczę prób
     */
    private function incrementAttempts($key, $decayMinutes)
    {
        if (!isset($this->cache[$key])) {
            $this->cache[$key] = [
                'count' => 1,
                'reset' => time() + ($decayMinutes * 60)
            ];
        } else {
            if (time() > $this->cache[$key]['reset']) {
                // Zresetuj
                $this->cache[$key]['count'] = 1;
                $this->cache[$key]['reset'] = time() + ($decayMinutes * 60);
            } else {
                // Inkrementuj
                $this->cache[$key]['count']++;
            }
        }
    }
}
```

### 8.2 Użycie Rate Limiting

```php
<?php
namespace App\Controllers;

use App\Core\RateLimiter;

class KontaktController extends BaseController
{
    public function wyslij()
    {
        $rateLimiter = new RateLimiter();
        $clientIp = $_SERVER['REMOTE_ADDR'];
        
        // Sprawdzaj rate limiting - max 5 submitów na godzinę na IP
        if (!$rateLimiter->allow("kontakt_{$clientIp}", 5, 60)) {
            http_response_code(429);
            $this->json([
                'error' => 'Za dużo żądań. Spróbuj ponownie za kilka minut.'
            ], 429);
        }
        
        // Kontynuuj przetwarzanie formularza
        // ...
    }
}
```

---

## 9. Security Headers

### 9.1 Konfiguracja Headers'ów

**Plik: public/index.php (na samym początku)**

```php
<?php

// Content Security Policy
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; img-src 'self' data: https:; font-src 'self' https:;");

// Prevent Clickjacking
header("X-Frame-Options: SAMEORIGIN");

// Prevent MIME sniffing
header("X-Content-Type-Options: nosniff");

// Enable XSS Protection (starsze przeglądarki)
header("X-XSS-Protection: 1; mode=block");

// Referrer Policy
header("Referrer-Policy: strict-origin-when-cross-origin");

// Permissions Policy
header("Permissions-Policy: geolocation=(), microphone=(), camera=()");

// HSTS (Strict-Transport-Security)
header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
```

---

## 10. Checklist Bezpieczeństwa

### Przed Deploymentem:
- ✅ Wyłącz display_errors w php.ini
- ✅ Włącz error logging
- ✅ Zabezpiecz wszystkie wejścia (POST, GET, FILES)
- ✅ Użyj prepared statements dla wszystkich query'ów
- ✅ Implementuj CSRF protection
- ✅ Hash hasła (password_hash)
- ✅ Rate limiting na formularzach
- ✅ Secure file uploads
- ✅ Security headers
- ✅ HTTPS/SSL certificate

### Regularnie:
- ✅ Update zależności PHP
- ✅ Patche bezpieczeństwa
- ✅ Backup bazy danych
- ✅ Monitoring logów
- ✅ Security audits
- ✅ Testing podatności
- ✅ Update rules firewall'a

---

## 11. OWASP Top 10 2021

| # | Zagrożenie | Rozwiązanie w Projekcie |
|---|---|---|
| 1 | Broken Access Control | Auth class, role-based access |
| 2 | Cryptographic Failures | Prepared statements, HTTPS/SSL |
| 3 | Injection | Sanitizer, prepared statements |
| 4 | Insecure Design | Security-first development |
| 5 | Security Misconfiguration | Security headers, .htaccess |
| 6 | Vulnerable Components | Composer dependencies audit |
| 7 | Authentication Failures | Auth class, password hashing |
| 8 | Data Integrity Failures | CSRF tokens, signed cookies |
| 9 | Logging Failures | Error logging, monitoring |
| 10 | SSRF | URL validation, firewall |

---

## 12. Przykład: Bezpieczny Formularz Kontaktu

```php
<?php
// KontaktController.php - Bezpieczna obsługa formularza

namespace App\Controllers;

use App\Core\Validator;
use App\Core\Sanitizer;
use App\Core\Csrf;
use App\Core\RateLimiter;

class KontaktController extends BaseController
{
    public function formularz()
    {
        // Generuj CSRF token dla formularza
        $token = Csrf::token();
        
        $this->render('kontakt', ['token' => $token]);
    }
    
    public function wyslij()
    {
        // 1. Sprawdzaj CSRF
        if (!Csrf::verify($_POST['_csrf_token'] ?? '')) {
            http_response_code(403);
            $this->json(['error' => 'Niepoprawny token'], 403);
        }
        
        // 2. Rate limiting
        $limiter = new RateLimiter();
        if (!$limiter->allow($_SERVER['REMOTE_ADDR'], 5, 60)) {
            http_response_code(429);
            $this->json(['error' => 'Za dużo żądań'], 429);
        }
        
        // 3. Waliduj dane
        $validator = new Validator($_POST);
        $validator->required('imie')->minLength('imie', 2)
                  ->required('email')->email('email')
                  ->required('temat')->minLength('temat', 5)
                  ->required('wiadomosc')->minLength('wiadomosc', 10);
        
        if ($validator->fails()) {
            $this->json(['errors' => $validator->getErrors()], 422);
        }
        
        // 4. Sanitize dane
        $imie = Sanitizer::text($_POST['imie']);
        $email = Sanitizer::email($_POST['email']);
        $temat = Sanitizer::text($_POST['temat']);
        $wiadomosc = Sanitizer::html($_POST['wiadomosc']);
        
        // 5. Zapisz do bazy (z prepared statement)
        try {
            $this->db->query(
                'INSERT INTO wiadomosci (imie, email, temat, wiadomosc, ip_adres, data_dodania) VALUES (?, ?, ?, ?, ?, NOW())',
                [$imie, $email, $temat, $wiadomosc, $_SERVER['REMOTE_ADDR']]
            );
            
            // 6. Wyślij email
            mail($email, "Potwierdzenie: " . $temat, "Dziękujemy za wiadomość!\n\n" . $wiadomosc);
            
            $this->json(['success' => true, 'message' => 'Wiadomość wysłana']);
        } catch (\Exception $e) {
            error_log("Błąd formularza: " . $e->getMessage());
            $this->json(['error' => 'Błąd serwera'], 500);
        }
    }
}
```

```html
<!-- kontakt.php - Bezpieczny formularz -->
<form method="POST" action="/kontakt">
    <!-- CSRF Token -->
    <?php echo Csrf::field(); ?>
    
    <div class="form-group">
        <label for="imie">Imię *</label>
        <input type="text" id="imie" name="imie" required minlength="2" maxlength="100">
    </div>
    
    <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" id="email" name="email" required>
    </div>
    
    <div class="form-group">
        <label for="temat">Temat *</label>
        <input type="text" id="temat" name="temat" required minlength="5" maxlength="200">
    </div>
    
    <div class="form-group">
        <label for="wiadomosc">Wiadomość *</label>
        <textarea id="wiadomosc" name="wiadomosc" required minlength="10" maxlength="5000"></textarea>
    </div>
    
    <button type="submit">Wyślij</button>
</form>
```

---

## Podsumowanie

Bezpieczeństwo to proces ciągły. Projekt **Malarz Trzebnica** chroni się przed:

✅ SQL Injection (prepared statements)
✅ XSS (sanitizing & escaping)
✅ CSRF (tokens)
✅ Session hijacking (secure cookies)
✅ Brute force (rate limiting)
✅ File upload attacks (validation)
✅ Weak passwords (password hashing)
✅ Information disclosure (error handling)

Zawsze pamiętaj: **Bezpieczeństwo nie jest funkcją, to proces!**

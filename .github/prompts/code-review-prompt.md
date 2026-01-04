# 🔍 Code Review Prompt - PHP 8.4 & PSR-12

**Wersja:** 1.0.0  
**Data:** 2024-12-15  
**Przeznaczenie:** AI-assisted code review dla projektu adwokat-trzebnica-bootstrap-to-php

---

## 🎯 Kontekst Projektu

Przegląd kodu dla projektu strony internetowej Kancelarii Adwokackiej Katarzyny Maj:
- **Stack technologiczny:** PHP 8.4, Bootstrap 5.3, HTML5, CSS3, JavaScript ES6+
- **Standard kodowania:** PSR-12
- **Architektura:** Component-based PHP z modularną strukturą
- **Cel:** Wysokiej jakości, bezpieczny, wydajny kod zgodny z najlepszymi praktykami

---

## 📋 Zakres Code Review

Przeprowadź kompleksowy przegląd kodu PHP, sprawdzając następujące aspekty:

### 1. 🏗️ Architektura i Struktura

**Sprawdź:**
- [ ] Czy kod jest podzielony na logiczne komponenty?
- [ ] Czy używana jest właściwa separacja odpowiedzialności (SoC)?
- [ ] Czy struktura katalogów jest zgodna z projektem?
- [ ] Czy stosowane są namespace'y zgodnie z PSR-4?
- [ ] Czy unikamy duplikacji kodu (DRY principle)?
- [ ] Czy kod jest testowalny (możliwość testowania jednostkowego)?

**Lokalizacje do sprawdzenia:**
```
/dist/adwokat-trzebnica.com/
├── components/     # Komponenty wielokrotnego użytku
├── includes/       # Konfiguracja, funkcje pomocnicze
└── templates/      # Szablony stron
```

---

### 2. 📏 PSR-12 Compliance

**Wymagania:**
- [ ] `declare(strict_types=1);` na początku każdego pliku PHP
- [ ] Proper namespace deklaracje
- [ ] Wcięcia: 4 spacje (nie tabulatory)
- [ ] Długość linii: max 120 znaków (soft limit)
- [ ] Opening braces `{` na tej samej linii dla funkcji i klas
- [ ] Closing braces `}` na osobnej linii
- [ ] Exactly one blank line after namespace declaration
- [ ] Use statements po namespace, alfabetycznie
- [ ] Visibility (public/private/protected) dla wszystkich properties i methods

**Przykład prawidłowego kodu:**
```php
<?php

declare(strict_types=1);

namespace AdwokatTrzebnica\Components;

use AdwokatTrzebnica\Security\CSRF;
use AdwokatTrzebnica\Security\Sanitizer;

class ContactForm
{
    private CSRF $csrf;
    private Sanitizer $sanitizer;
    
    public function __construct(CSRF $csrf, Sanitizer $sanitizer)
    {
        $this->csrf = $csrf;
        $this->sanitizer = $sanitizer;
    }
    
    public function render(): string
    {
        // Implementation
    }
}
```

---

### 3. 🔒 Security (OWASP Top 10)

**Sprawdź czy kod chroni przed:**

#### A. XSS (Cross-Site Scripting)
- [ ] Czy WSZYSTKIE dane wyjściowe są escapowane?
- [ ] Czy używane jest `htmlspecialchars($var, ENT_QUOTES | ENT_HTML5, 'UTF-8')`?
- [ ] Czy dla JSON używane jest `json_encode($var, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)`?

**❌ BŁĄD:**
```php
echo $userInput;  // XSS vulnerability!
```

**✅ PRAWIDŁOWO:**
```php
echo htmlspecialchars($userInput, ENT_QUOTES | ENT_HTML5, 'UTF-8');
// Lub helper function:
echo e($userInput);
```

#### B. CSRF (Cross-Site Request Forgery)
- [ ] Czy wszystkie formularze mają token CSRF?
- [ ] Czy token jest weryfikowany przed przetworzeniem danych?
- [ ] Czy token ma odpowiedni czas życia (timeout)?

**Wymagane:**
```php
// Generowanie tokenu
$csrf = new CSRF();
$token = $csrf->generateToken();

// W formularzu
<input type="hidden" name="csrf_token" value="<?= e($token) ?>">

// Walidacja
if (!$csrf->validateToken($_POST['csrf_token'] ?? '')) {
    die('Invalid CSRF token');
}
```

#### C. SQL Injection (jeśli używana baza danych)
- [ ] Czy WSZYSTKIE zapytania używają prepared statements?
- [ ] Czy NIE ma konkatenacji SQL z danymi użytkownika?

**❌ BŁĄD:**
```php
$query = "SELECT * FROM users WHERE email = '$email'";  // SQL Injection!
```

**✅ PRAWIDŁOWO:**
```php
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
```

#### D. Input Validation
- [ ] Czy wszystkie dane wejściowe są walidowane?
- [ ] Czy używane są właściwe filtry (`filter_var`, `filter_input`)?
- [ ] Czy walidacja jest zarówno po stronie klienta (JS) jak i serwera (PHP)?

**Przykład:**
```php
// Email validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    throw new InvalidArgumentException('Invalid email format');
}

// Phone validation (Polish format)
if (!preg_match('/^(\+?48)?[0-9]{9}$/', $phone)) {
    throw new InvalidArgumentException('Invalid phone number');
}
```

#### E. Sensitive Data Exposure
- [ ] Czy hasła/klucze NIE są hardcoded w kodzie?
- [ ] Czy używane są zmienne środowiskowe (.env)?
- [ ] Czy `.env` jest w `.gitignore`?
- [ ] Czy error messages nie ujawniają wrażliwych danych?

---

### 4. 🎯 PHP 8.4 Best Practices

**Sprawdź wykorzystanie funkcji PHP 8.x:**

#### A. Strict Types
```php
// WYMAGANE w każdym pliku
declare(strict_types=1);
```

#### B. Type Declarations
- [ ] Wszystkie parametry funkcji mają deklaracje typów
- [ ] Wszystkie return types są zadeklarowane
- [ ] Używane union types gdzie potrzebne (PHP 8.0+)
- [ ] Używane nullable types (`?string`, `?int`)

**Przykład:**
```php
public function processData(
    string $name,
    int $age,
    ?string $email = null
): array|false {
    // Implementation
}
```

#### C. Match Expressions (PHP 8.0+)
Preferuj `match` zamiast `switch` gdzie możliwe:

**✅ PREFEROWANE:**
```php
$status = match($code) {
    200 => 'Success',
    404 => 'Not Found',
    500 => 'Server Error',
    default => 'Unknown'
};
```

#### D. Named Arguments (PHP 8.0+)
```php
// Czytelne wywołania funkcji
sendEmail(
    to: 'client@example.com',
    subject: 'Konsultacja prawna',
    body: $emailBody,
    attachments: []
);
```

#### E. Constructor Property Promotion (PHP 8.0+)
```php
class ContactForm
{
    public function __construct(
        private CSRF $csrf,
        private Sanitizer $sanitizer,
        private Mailer $mailer
    ) {
    }
}
```

#### F. Nullsafe Operator (PHP 8.0+)
```php
$city = $user?->getAddress()?->getCity();
```

---

### 5. 📝 Code Quality

#### A. Naming Conventions
- [ ] **Klasy:** PascalCase (`ContactForm`, `EmailHandler`)
- [ ] **Metody/Funkcje:** camelCase (`sendEmail`, `validateInput`)
- [ ] **Zmienne:** camelCase (`$userEmail`, `$firstName`)
- [ ] **Stałe:** SCREAMING_SNAKE_CASE (`MAX_FILE_SIZE`, `ALLOWED_EXTENSIONS`)
- [ ] **Nazwy są opisowe** (nie `$x`, `$temp`, `$data`)

#### B. Documentation
- [ ] Czy klasy mają PHPDoc comments?
- [ ] Czy metody publiczne mają opisane parametry i return types?
- [ ] Czy skomplikowane fragmenty mają komentarze wyjaśniające?

**Przykład:**
```php
/**
 * Send contact form email to law office
 *
 * @param string $name Client's full name
 * @param string $email Client's email address
 * @param string $message Message content
 * @param string $csrfToken CSRF protection token
 * @return bool True on success, false on failure
 * @throws InvalidArgumentException If validation fails
 * @throws MailerException If email sending fails
 */
public function sendContactForm(
    string $name,
    string $email,
    string $message,
    string $csrfToken
): bool {
    // Implementation
}
```

#### C. Function Length
- [ ] Funkcje nie powinny mieć więcej niż 50 linii
- [ ] Jeśli funkcja jest dłuższa, czy można ją rozbić na mniejsze?
- [ ] Każda funkcja robi ONE THING (Single Responsibility)

#### D. Complexity
- [ ] Unikaj zagnieżdżonych pętli (nested loops > 2 levels)
- [ ] Unikaj głębokich zagnieżdżeń if-else (> 3 levels)
- [ ] Czy można uprościć logikę?

**❌ ZŁE (zbyt złożone):**
```php
if ($condition1) {
    if ($condition2) {
        if ($condition3) {
            if ($condition4) {
                // Code
            }
        }
    }
}
```

**✅ LEPIEJ:**
```php
if (!$condition1 || !$condition2 || !$condition3 || !$condition4) {
    return;
}
// Code
```

---

### 6. ⚡ Performance

#### A. Database Queries (jeśli używane)
- [ ] Czy zapytania nie są wykonywane w pętlach (N+1 problem)?
- [ ] Czy używane są indeksy?
- [ ] Czy SELECT pobiera tylko potrzebne kolumny (nie `SELECT *`)?

#### B. Caching
- [ ] Czy wyniki kosztownych operacji są cache'owane?
- [ ] Czy OPcache jest włączony w produkcji?

#### C. File Operations
- [ ] Czy pliki są zamykane po użyciu?
- [ ] Czy używane `fclose()` po `fopen()`?

#### D. Autoloading
- [ ] Czy używany Composer autoload?
- [ ] Czy klasy nie są ładowane ręcznie przez `require`/`include`?

---

### 7. 🧪 Testability

- [ ] Czy kod można przetestować jednostkowo?
- [ ] Czy zależności są wstrzykiwane (Dependency Injection)?
- [ ] Czy unikamy globalnego stanu (`$_SESSION`, `$_COOKIE` bezpośrednio)?
- [ ] Czy funkcje zwracają wartości zamiast printować?

**✅ TESTABLE:**
```php
class EmailService
{
    public function __construct(private Mailer $mailer) {}
    
    public function send(string $to, string $subject, string $body): bool
    {
        return $this->mailer->send($to, $subject, $body);
    }
}

// Łatwo mockować $mailer w testach
```

---

### 8. 🌍 Accessibility & SEO

#### A. HTML Output
- [ ] Czy wszystkie obrazy mają `alt` attributes?
- [ ] Czy używane semantic HTML5 (`<header>`, `<nav>`, `<main>`, `<footer>`)?
- [ ] Czy formularze mają `<label>` dla każdego `<input>`?
- [ ] Czy kontrast kolorów spełnia WCAG 2.2 Level AA?

#### B. SEO
- [ ] Czy każda strona ma unikalny `<title>`?
- [ ] Czy każda strona ma `<meta name="description">`?
- [ ] Czy używane Schema.org markup?
- [ ] Czy URLs są SEO-friendly (nie `?page=1`)?

---

### 9. 📦 Dependencies

- [ ] Czy `composer.json` zawiera tylko potrzebne zależności?
- [ ] Czy wersje pakietów są określone (nie `*` ani `dev-master`)?
- [ ] Czy `composer.lock` jest w repozytorium?
- [ ] Czy używane `composer audit` do sprawdzania bezpieczeństwa?

---

### 10. 🔧 Configuration

#### A. Environment Variables
- [ ] Czy używane `.env` dla konfiguracji?
- [ ] Czy `.env.example` istnieje?
- [ ] Czy `.env` jest w `.gitignore`?
- [ ] Czy produkcyjne dane (SMTP, klucze) NIE są w kodzie?

#### B. Error Handling
- [ ] Czy w produkcji `display_errors = Off`?
- [ ] Czy błędy są logowane do pliku?
- [ ] Czy custom error pages istnieją (404, 500)?

---

## 📊 Code Review Checklist

Po przeglądzie kodu, wypełnij:

### Overall Code Quality: ⭐⭐⭐⭐⭐ (1-5)

| Kategoria | Ocena | Komentarz |
|-----------|-------|-----------|
| PSR-12 Compliance | ⭐⭐⭐⭐⭐ |  |
| Security | ⭐⭐⭐⭐⭐ |  |
| PHP 8.4 Usage | ⭐⭐⭐⭐⭐ |  |
| Code Quality | ⭐⭐⭐⭐⭐ |  |
| Performance | ⭐⭐⭐⭐⭐ |  |
| Testability | ⭐⭐⭐⭐⭐ |  |
| Documentation | ⭐⭐⭐⭐⭐ |  |

---

## 🚨 Critical Issues (Fix Immediately)

Lista krytycznych problemów wymagających natychmiastowej naprawy:

1. **[SECURITY]** ...
2. **[BUG]** ...
3. **[CRITICAL]** ...

---

## ⚠️ Major Issues (Fix Before Merge)

Lista ważnych problemów do naprawy przed mergem:

1. **[CODE QUALITY]** ...
2. **[PERFORMANCE]** ...
3. **[STANDARD]** ...

---

## 💡 Suggestions (Nice to Have)

Sugestie ulepszeń (opcjonalnie):

1. **[REFACTOR]** ...
2. **[OPTIMIZATION]** ...
3. **[IMPROVEMENT]** ...

---

## ✅ Approved / ❌ Needs Work

**Status:** [✅ Zatwierdzony do merge | ❌ Wymaga poprawek]

**Komentarz:**

---

## 🎓 AI Instructions

Jako AI reviewer:

1. **Bądź konkretny:** Wskaż dokładnie gdzie jest problem (plik, linia)
2. **Podaj przykłady:** Pokaż jak powinien wyglądać poprawiony kod
3. **Wyjaśnij "dlaczego":** Nie tylko "co" jest złe, ale "dlaczego"
4. **Priorytetyzuj:** Rozróżniaj krytyczne błędy od sugestii
5. **Bądź konstruktywny:** Cel to pomoc, nie krytyka
6. **Sprawdź kontekst:** Rozumiej cel kodu przed krytyką

**Przykład feedback:**

```
❌ PROBLEM (Security - Critical)
Plik: /dist/adwokat-trzebnica.com/components/ContactForm.php
Linia: 42

Obecny kod:
    echo $_POST['name'];

Problem: Dane wejściowe nie są escapowane, co prowadzi do XSS.

Poprawka:
    echo htmlspecialchars($_POST['name'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

Lub użyj helper function:
    echo e($_POST['name']);

Dlaczego: Bez escapowania, użytkownik może wstrzyknąć kod JavaScript,
który wykona się w przeglądarce innych użytkowników.
```

---

**Ostatnia aktualizacja:** 2024-12-15  
**Owner:** Kancelaria Adwokacka Katarzyna Maj

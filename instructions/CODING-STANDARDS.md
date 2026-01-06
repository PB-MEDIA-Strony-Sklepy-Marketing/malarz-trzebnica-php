# Standardy Kodowania - Malarz Trzebnica PHP

> **Przewodnik po standardach kodowania dla projektu malarz-trzebnica-php**

## Spis Treści

1. [Wprowadzenie](#wprowadzenie)
2. [Standardy PHP](#standardy-php)
3. [Standardy HTML](#standardy-html)
4. [Standardy CSS](#standardy-css)
5. [Standardy JavaScript](#standardy-javascript)
6. [Konwencje Nazewnictwa](#konwencje-nazewnictwa)
7. [Komentarze i Dokumentacja](#komentarze-i-dokumentacja)
8. [Struktura Plików](#struktura-plików)

---

## Wprowadzenie

Ten dokument definiuje standardy kodowania obowiązujące w projekcie strony internetowej firmy **Malarz Trzebnica**. Przestrzeganie tych standardów zapewnia:

- **Jednolitość kodu** - łatwiejsza współpraca zespołowa
- **Czytelność** - szybsze zrozumienie logiki aplikacji
- **Maintainability** - łatwiejsza konserwacja i rozwój
- **Jakość** - mniej błędów i wyższa stabilność

---

## Standardy PHP

### PSR Standards

Projekt stosuje oficjalne standardy PHP-FIG:

- **PSR-4** - Autoloading klas
- **PSR-12** - Extended Coding Style Guide

### Podstawowe Zasady

```php
<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use App\Services\EmailService;

/**
 * Kontroler obsługujący stronę kontaktową
 * 
 * @package App\Controllers
 */
class ContactController extends Controller
{
    /**
     * Serwis wysyłki e-mail
     * 
     * @var EmailService
     */
    private EmailService $emailService;

    /**
     * Konstruktor kontrolera
     * 
     * @param EmailService $emailService
     */
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * Wyświetla formularz kontaktowy
     * 
     * @return void
     */
    public function index(): void
    {
        $this->render('contact/index', [
            'title' => 'Kontakt - Malarz Trzebnica',
        ]);
    }
}
```

### Naming Conventions PHP

| Element | Konwencja | Przykład |
|---------|-----------|----------|
| Namespace | PascalCase | `App\Controllers` |
| Klasa | PascalCase | `ContactController` |
| Metoda | camelCase | `sendEmail()` |
| Właściwość | camelCase | `$emailService` |
| Stała klasy | UPPER_SNAKE_CASE | `MAX_FILE_SIZE` |
| Stała globalna | UPPER_SNAKE_CASE | `DB_HOST` |

### Formatowanie Kodu

```php
<?php

// ✅ DOBRZE - wcięcia 4 spacje
class ContactController
{
    public function send(): void
    {
        if ($this->validate()) {
            // logika
        }
    }
}

// ❌ ŹLE - tabulatory lub 2 spacje
class ContactController
{
  public function send(): void
  {
    if ($this->validate()) {
      // logika
    }
  }
}
```

### Type Declarations

**Zawsze używaj type hints:**

```php
<?php

// ✅ DOBRZE
public function calculatePrice(float $amount, int $quantity): float
{
    return $amount * $quantity;
}

// ❌ ŹLE
public function calculatePrice($amount, $quantity)
{
    return $amount * $quantity;
}
```

### Error Handling

```php
<?php

// ✅ DOBRZE - konkretne wyjątki
try {
    $result = $this->processPayment($data);
} catch (PaymentException $e) {
    $this->logger->error('Payment failed: ' . $e->getMessage());
    throw new ServiceException('Unable to process payment', 0, $e);
}

// ❌ ŹLE - łapanie wszystkich wyjątków
try {
    $result = $this->processPayment($data);
} catch (Exception $e) {
    // zbyt ogólne
}
```

---

## Standardy HTML

### Struktura Dokumentu

```html
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tytuł Strony - Malarz Trzebnica</title>
  
  <!-- Meta SEO -->
  <meta name="description" content="Opis strony">
  
  <!-- CSS -->
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
  <!-- Treść -->
  
  <!-- JavaScript na końcu body -->
  <script src="/assets/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/app.js"></script>
</body>
</html>
```

### Semantyczne Znaczniki

```html
<!-- ✅ DOBRZE - semantyczny HTML5 -->
<header>
  <nav>
    <ul>
      <li><a href="/">Strona główna</a></li>
    </ul>
  </nav>
</header>

<main>
  <article>
    <h1>Tytuł artykułu</h1>
    <p>Treść...</p>
  </article>
</main>

<footer>
  <p>&copy; 2025 Malarz Trzebnica</p>
</footer>

<!-- ❌ ŹLE - divs soup -->
<div class="header">
  <div class="nav">
    <div class="menu">...</div>
  </div>
</div>
```

### Atrybuty i Wcięcia

```html
<!-- ✅ DOBRZE - 2 spacje, lowercase -->
<button 
  type="submit" 
  class="btn btn-primary" 
  id="submitBtn"
  aria-label="Wyślij formularz">
  Wyślij
</button>

<!-- ❌ ŹLE -->
<BUTTON TYPE="submit" CLASS="btn btn-primary" id=submitBtn>Wyślij</BUTTON>
```

---

## Standardy CSS

### Metodologia BEM (Block Element Modifier)

```css
/* Block */
.contact-form {
  padding: 20px;
}

/* Element */
.contact-form__input {
  width: 100%;
  padding: 10px;
}

/* Modifier */
.contact-form__input--error {
  border-color: red;
}
```

### Organizacja Właściwości

```css
.selector {
  /* Positioning */
  position: relative;
  top: 0;
  left: 0;
  z-index: 10;
  
  /* Display & Box Model */
  display: flex;
  width: 100%;
  height: auto;
  padding: 20px;
  margin: 0 auto;
  
  /* Typography */
  font-family: 'Arial', sans-serif;
  font-size: 16px;
  line-height: 1.5;
  color: #333;
  
  /* Visual */
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 4px;
  
  /* Animation */
  transition: all 0.3s ease;
}
```

### Mobile-First Approach

```css
/* ✅ DOBRZE - mobile first */
.container {
  padding: 10px;
}

@media (min-width: 768px) {
  .container {
    padding: 20px;
  }
}

@media (min-width: 1200px) {
  .container {
    padding: 30px;
  }
}

/* ❌ ŹLE - desktop first */
.container {
  padding: 30px;
}

@media (max-width: 768px) {
  .container {
    padding: 10px;
  }
}
```

---

## Standardy JavaScript

### Modern ES6+ Syntax

```javascript
// ✅ DOBRZE - const/let, arrow functions
const API_URL = 'https://api.example.com';

const fetchData = async (endpoint) => {
  try {
    const response = await fetch(`${API_URL}/${endpoint}`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Fetch error:', error);
    throw error;
  }
};

// ❌ ŹLE - var, function keyword
var API_URL = 'https://api.example.com';

function fetchData(endpoint) {
  // stary callback hell
}
```

### Naming Conventions JavaScript

```javascript
// Zmienne i funkcje - camelCase
const userName = 'Jan';
const calculateTotal = (items) => { /* ... */ };

// Klasy - PascalCase
class ContactForm {
  constructor() { /* ... */ }
}

// Stałe - UPPER_SNAKE_CASE
const MAX_ITEMS = 100;
const API_KEY = 'abc123';

// Prywatne właściwości - prefix _
class User {
  _privateData = {};
  
  get data() {
    return this._privateData;
  }
}
```

### Event Handlers

```javascript
// ✅ DOBRZE - event delegation
document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('#contactForm');
  
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    handleFormSubmit(form);
  });
});

// ❌ ŹLE - inline handlers
// <button onclick="handleClick()">Click</button>
```

---

## Konwencje Nazewnictwa

### Pliki

```
✅ DOBRZE:
- ContactController.php (klasy PHP - PascalCase)
- contact-form.js (pliki JS - kebab-case)
- main-style.css (pliki CSS - kebab-case)
- homepage.md (dokumentacja - lowercase)

❌ ŹLE:
- contactController.php
- ContactForm.js
- Main_Style.css
- HomePage.MD
```

### Katalogi

```
✅ DOBRZE:
- dist/controllers/
- dist/models/
- dist/views/
- assets/images/
- docs/guides/

❌ ŹLE:
- dist/Controllers/
- Dist/Models/
- ASSETS/IMAGES/
```

### Bazy Danych (jeśli używana)

```sql
-- Tabele - snake_case, liczba mnoga
CREATE TABLE users (
    -- Kolumny - snake_case
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100),
    email_address VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Indeksy - idx_table_column
CREATE INDEX idx_users_email ON users(email_address);
```

---

## Komentarze i Dokumentacja

### PHPDoc dla Klas i Metod

```php
<?php

/**
 * Serwis do wysyłki e-maili z formularza kontaktowego
 * 
 * Wykorzystuje PHPMailer do wysyłki wiadomości SMTP.
 * Wspiera szablony HTML oraz walidację danych wejściowych.
 * 
 * @package App\Services
 * @author  Malarz Trzebnica <kontakt@malarz.trzebnica.pl>
 * @version 1.0.0
 * @since   2025-01-06
 */
class EmailService
{
    /**
     * Wysyła e-mail z formularza kontaktowego
     * 
     * @param string $to      Adres odbiorcy
     * @param string $subject Temat wiadomości
     * @param string $body    Treść HTML
     * @param array  $from    Dane nadawcy ['email', 'name']
     * 
     * @return bool True jeśli wysłano, false w przeciwnym razie
     * 
     * @throws \PHPMailer\PHPMailer\Exception Gdy wysyłka się nie powiedzie
     */
    public function send(string $to, string $subject, string $body, array $from): bool
    {
        // Implementacja
    }
}
```

### Komentarze w Kodzie

```php
<?php

// ✅ DOBRZE - wyjaśnia "dlaczego", nie "co"
// Zabezpieczenie przed XSS - wszystkie dane od użytkownika są escapowane
$safeName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

// Timeout zwiększony do 60s ze względu na wolne API zewnętrznego dostawcy
$timeout = 60;

// ❌ ŹLE - oczywiste komentarze
// Przypisanie zmiennej
$name = $_POST['name'];

// Pętla foreach
foreach ($items as $item) {
    // Wyświetlenie item
    echo $item;
}
```

### TODO Komentarze

```php
<?php

// TODO: Dodać cache dla wyników zapytania (Issue #123)
// FIXME: Race condition przy równoczesnych requestach (Issue #456)
// HACK: Tymczasowe obejście - do refaktoryzacji w wersji 2.0
// NOTE: To zachowanie jest zamierzone ze względu na legacy API
```

---

## Struktura Plików

### Organizacja Kodu PHP

```
dist/
├── app/
│   ├── Controllers/          # Kontrolery MVC
│   │   ├── HomeController.php
│   │   ├── ContactController.php
│   │   └── GalleryController.php
│   │
│   ├── Models/               # Modele danych
│   │   └── Contact.php
│   │
│   ├── Services/             # Logika biznesowa
│   │   ├── EmailService.php
│   │   └── ValidationService.php
│   │
│   ├── Helpers/              # Funkcje pomocnicze
│   │   └── functions.php
│   │
│   └── Views/                # Szablony widoków
│       ├── layouts/
│       ├── partials/
│       └── pages/
│
├── config/                   # Konfiguracja
│   ├── config.php
│   ├── database.php
│   └── routes.php
│
├── core/                     # Framework MVC
│   ├── Router.php
│   ├── Controller.php
│   └── View.php
│
├── public/                   # Pliki publiczne
│   ├── index.php
│   └── assets/
│
└── vendor/                   # Composer dependencies
```

---

## Walidacja i Linting

### Automatyczne Sprawdzanie

```bash
# PHP CodeSniffer - PSR-12
composer run lint

# PHPStan - analiza statyczna
composer run analyse

# Automatyczne poprawki
composer run lint:fix
```

### Integracja z IDE

Zalecane rozszerzenia dla VS Code:

- PHP Intelephense
- PHP CS Fixer
- ESLint
- Prettier
- EditorConfig for VS Code

---

## Checklist Code Review

Przed zatwierdzeniem PR sprawdź:

- [ ] Kod przestrzega PSR-4 i PSR-12
- [ ] Wszystkie funkcje mają type hints
- [ ] Dodano PHPDoc dla publicznych metod
- [ ] Brak hardcoded credentials
- [ ] Komentarze wyjaśniają "dlaczego", nie "co"
- [ ] Testy jednostkowe (jeśli dotyczy)
- [ ] Brak warnings z PHP CodeSniffer
- [ ] Brak błędów z PHPStan
- [ ] Semantyczny HTML
- [ ] Mobile-first CSS
- [ ] ES6+ JavaScript
- [ ] Accessibility (ARIA labels, alt texts)

---

## Zasoby

### Dokumentacja Standardów

- [PSR-4: Autoloader](https://www.php-fig.org/psr/psr-4/)
- [PSR-12: Extended Coding Style](https://www.php-fig.org/psr/psr-12/)
- [BEM Methodology](http://getbem.com/)
- [MDN Web Docs](https://developer.mozilla.org/)

### Narzędzia

- [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
- [PHPStan](https://phpstan.org/)
- [ESLint](https://eslint.org/)
- [Prettier](https://prettier.io/)

---

**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm  
*Dokument wersja 1.0.0 - 2025-01-06*

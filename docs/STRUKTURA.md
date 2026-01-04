# Struktura Projektu - Malarz Trzebnica

Szczegółowy opis architektury i struktury katalogów projektu **www.malarz.trzebnica.pl**

---

## 📋 Spis treści

1. [Przegląd struktury](#przegląd-struktury)
2. [Katalog główny projektu](#katalog-główny-projektu)
3. [Katalog produkcyjny dist/](#katalog-produkcyjny-dist)
4. [Katalog źródłowy src/](#katalog-źródłowy-src)
5. [Dokumentacja docs/](#dokumentacja-docs)
6. [GitHub workflows](#github-workflows)
7. [Pliki konfiguracyjne](#pliki-konfiguracyjne)
8. [Diagram architektury](#diagram-architektury)

---

## 🗂️ Przegląd struktury

```
malarz-trzebnica-php/
│
├── .github/                    # Konfiguracja GitHub
│   ├── workflows/             # GitHub Actions CI/CD
│   │   ├── php-lint.yml       # PHP syntax check & PSR-12
│   │   ├── deploy-production.yml  # Automatyczne wdrożenie
│   │   ├── lighthouse-ci.yml  # Testy wydajności
│   │   └── backup.yml         # Cotygodniowe backupy
│   ├── ISSUE_TEMPLATE/        # Szablony issues
│   │   ├── bug_report.md      # Szablon zgłaszania błędów
│   │   └── feature_request.md # Szablon propozycji funkcjonalności
│   ├── PULL_REQUEST_TEMPLATE.md  # Szablon pull requestów
│   ├── CODEOWNERS             # Właściciele kodu
│   ├── agents/                # Agenci AI (Claude, GitHub Copilot)
│   ├── prompts/               # Prompty dla AI
│   └── knowledge/             # Baza wiedzy dla AI
│
├── dist/                       # 🎯 KATALOG PRODUKCYJNY (deploy tutaj)
│   ├── index.php              # Strona główna
│   ├── oferta.php             # Podstrona z ofertą usług
│   ├── galeria.php            # Galeria zdjęć realizacji
│   ├── kontakt.php            # Formularz kontaktowy
│   ├── template.php           # Szablon testowy (do usunięcia)
│   │
│   ├── includes/              # Komponenty PHP
│   │   ├── header.php         # Nagłówek strony (head, nawigacja)
│   │   ├── footer.php         # Stopka strony
│   │   ├── config.php         # Konfiguracja globalna
│   │   └── functions.php      # Funkcje pomocnicze
│   │
│   ├── assets/                # Zasoby statyczne
│   │   ├── css/               # Arkusze stylów
│   │   │   ├── bootstrap.min.css  # Framework Bootstrap 5
│   │   │   ├── style.css      # Główne style niestandardowe
│   │   │   ├── media.css      # Media queries (responsywność)
│   │   │   ├── animate.min.css  # Animacje CSS
│   │   │   └── swiper-bundle.min.css  # Swiper slider
│   │   │
│   │   ├── js/                # Skrypty JavaScript
│   │   │   ├── bootstrap.bundle.min.js  # Bootstrap JS
│   │   │   ├── jquery-3.7.1.min.js  # jQuery library
│   │   │   ├── swiper-bundle.min.js  # Swiper slider
│   │   │   ├── gsap.min.js    # GSAP animations
│   │   │   ├── ScrollTrigger.min.js  # GSAP ScrollTrigger
│   │   │   ├── custom.js      # Niestandardowe skrypty
│   │   │   └── form-validation.js  # Walidacja formularzy
│   │   │
│   │   ├── image/             # Obrazy i grafiki
│   │   │   ├── svg/           # Ikony SVG
│   │   │   ├── home/          # Zdjęcia dla strony głównej
│   │   │   ├── gallery/       # Zdjęcia galerii
│   │   │   └── logo/          # Logo firmy
│   │   │
│   │   ├── font/              # Czcionki webowe
│   │   │   └── swap.css       # Google Fonts
│   │   │
│   │   └── video/             # Pliki wideo (opcjonalnie)
│   │
│   ├── uploads/               # Katalog dla plików użytkownika
│   │   ├── gallery/           # Zdjęcia galerii (dodawane przez klienta)
│   │   └── .htaccess          # Zabezpieczenia uploads
│   │
│   ├── .htaccess              # Konfiguracja Apache (routing, cache, security)
│   └── robots.txt             # SEO - instrukcje dla robotów
│
├── src/                        # Katalog źródłowy (szablon HTML Bootstrap)
│   ├── index.html             # Oryginalny szablon Bootstrap
│   ├── *.html                 # Inne strony HTML szablonu
│   └── assets/                # Oryginalne zasoby szablonu
│       ├── css/
│       ├── js/
│       └── image/
│
├── docs/                       # 📚 DOKUMENTACJA PROJEKTU
│   ├── INSTALACJA.md          # Instrukcja instalacji
│   ├── STRUKTURA.md           # ⬅️ TEN PLIK - Opis struktury
│   ├── EDYCJA_TRESCI.md       # Jak edytować treści
│   ├── WYMAGANIA.md           # Wymagania techniczne
│   ├── ARCHITEKTURA-MVC.md    # Architektura MVC
│   ├── GALERIA-LIGHTBOX.md    # Implementacja galerii
│   ├── SEO.md                 # Optymalizacja SEO
│   ├── BEZPIECZENSTWO.md      # Zabezpieczenia
│   ├── DEPLOYMENT.md          # Instrukcja wdrożenia
│   ├── CHANGELOG.md           # Historia zmian
│   └── API-DOCUMENTATION.md   # Dokumentacja API formularza
│
├── agents/                     # Lokalne kopie agentów AI
│   └── (kopie z .github/agents/)
│
├── prompts/                    # Lokalne kopie promptów
│   └── (kopie z .github/prompts/)
│
├── knowledge/                  # Lokalna baza wiedzy
│   └── (kopie z .github/knowledge/)
│
├── instructions/               # Instrukcje deweloperskie
│   ├── CODING-STANDARDS.md    # Standardy kodowania
│   ├── GIT-WORKFLOW.md        # Workflow Git
│   └── TESTING.md             # Strategie testowania
│
├── text/                       # Treści tekstowe strony
│   ├── homepage.txt           # Teksty dla strony głównej
│   ├── services.txt           # Opisy usług
│   └── about.txt              # O firmie
│
├── collections/                # GitHub Copilot Collections
│   └── (kolekcje Copilot)
│
├── .editorconfig              # Standardy formatowania kodu
├── .gitignore                 # Pliki wykluczane z Git
├── .gitattributes             # Atrybuty Git
│
├── composer.json              # Zależności PHP (Composer)
├── composer.lock              # Zablokowane wersje pakietów
├── package.json               # Zależności JavaScript (NPM)
│
├── phpcs.xml                  # Konfiguracja PHP CodeSniffer
├── phpstan.neon               # Konfiguracja PHPStan
├── phpunit.xml                # Konfiguracja testów PHPUnit
│
├── lighthouserc.json          # Konfiguracja Lighthouse CI
│
├── README.md                  # Główny README projektu
├── CONFIG-FILE.md             # Mapa generowania plików
├── INFO-FILE.md               # Specyfikacja projektu
├── LICENSE                    # Licencja MIT
│
└── .env.example               # Przykładowa konfiguracja zmiennych środowiskowych
```

---

## 🏠 Katalog główny projektu

### Pliki konfiguracyjne

| Plik | Opis | Właściciel |
|------|------|-----------|
| **`.gitignore`** | Wykluczenia Git (vendor/, node_modules/, .env) | @devops |
| **`.gitattributes`** | Atrybuty Git (end-of-line normalization) | @devops |
| **`.editorconfig`** | Ujednolicenie formatowania kodu (IDE) | @developers |
| **`composer.json`** | Zależności PHP, autoloading PSR-4 | @backend-team |
| **`composer.lock`** | Zablokowane wersje pakietów PHP | @backend-team |
| **`package.json`** | Zależności JavaScript (opcjonalnie) | @frontend-team |
| **`phpcs.xml`** | Standardy PSR-12 dla PHP CodeSniffer | @lead-developer |
| **`phpstan.neon`** | Konfiguracja statycznej analizy PHPStan | @lead-developer |
| **`phpunit.xml`** | Konfiguracja testów jednostkowych | @qa-team |
| **`lighthouserc.json`** | Testy wydajności Lighthouse CI | @devops |

### Dokumentacja główna

| Plik | Opis |
|------|------|
| **`README.md`** | Główny plik README z overview projektu |
| **`LICENSE`** | Licencja MIT |
| **`CONFIG-FILE.md`** | Mapa wszystkich plików do wygenerowania (100 plików) |
| **`INFO-FILE.md`** | Szczegółowa specyfikacja zadania konwersji HTML→PHP |
| **`CHANGELOG.md`** | Historia zmian projektu (semantic versioning) |

---

## 🎯 Katalog produkcyjny `dist/`

**To jest katalog, który wdrażasz na serwer produkcyjny!**

### Strony PHP (główne pliki)

#### `index.php` - Strona główna
```php
<?php
// Strona główna - Hero section, prezentacja usług, CTA

require_once 'includes/config.php';
require_once 'includes/functions.php';

$page_title = "Malarz Trzebnica - Profesjonalne Usługi Malarskie";
$page_description = "Precision, Perfection, Professional - Usługi malarskie w Trzebnicy";

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero">
    <!-- Treść strony głównej -->
</section>

<?php include 'includes/footer.php'; ?>
```

**Zawartość:**
- Hero section z sloganem "Precision, Perfection, Professional"
- Prezentacja głównych usług (malowanie, szpachlowanie, GK)
- Call-to-action z numerem telefonu +48 452 690 824
- Sekcja "O nas" z profesjonalnym sprzętem
- Portfolio (wybrane realizacje)
- Opinie klientów
- Formularz kontaktowy (quick contact)

---

#### `oferta.php` - Oferta usług

**Zawartość:**
- **Usługi malarskie** (główna specjalizacja):
  - Malowanie wnętrz mieszkalnych
  - Malowanie elewacji budynków
  - Malowanie obiektów komercyjnych
- **Szpachlowanie ścian**
- **Sucha zabudowa GK** (ścianki działowe, sufity)
- **Układanie podłóg** (panele, wykładziny)
- **Układanie glazury** (łazienki, kuchnie)
- **Elementy wykończenia** (drobne prace remontowe)

**Format:** Bootstrap Cards lub Accordions

---

#### `galeria.php` - Galeria realizacji

**Zawartość:**
- **Kategoria 1:** Wnętrza mieszkalne
- **Kategoria 2:** Elewacje budynków
- **Kategoria 3:** Detale wykończeniowe

**Implementacja:**
- Responsywny grid (Bootstrap)
- Lightbox (GLightbox lub similar)
- Lazy loading obrazów
- Filtrowanie po kategorii

---

#### `kontakt.php` - Formularz kontaktowy

**Zawartość:**
- Formularz z polami:
  - Imię i nazwisko
  - Email
  - Telefon (opcjonalnie)
  - Wiadomość
  - Checkbox RODO
  - CSRF token (zabezpieczenie)
  - Honeypot (antyspam)
- Dane kontaktowe:
  - Telefon: +48 452 690 824
  - Email: kontakt@malarz.trzebnica.pl
  - Adres: Trzebnica
- Opcjonalnie: Google Maps embed

---

### Katalog `includes/`

#### `header.php` - Nagłówek strony

```php
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Malarz Trzebnica'; ?></title>
    <meta name="description" content="<?php echo $page_description ?? ''; ?>">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/css/style.css">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo $page_title; ?>">
    <meta property="og:description" content="<?php echo $page_description; ?>">
    
    <!-- Schema.org LocalBusiness -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "Malarz Trzebnica",
        "telephone": "+48452690824",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Trzebnica",
            "addressCountry": "PL"
        }
    }
    </script>
</head>
<body>
    <!-- Nawigacja -->
    <header>
        <nav class="navbar navbar-expand-lg">
            <!-- Menu items -->
        </nav>
    </header>
```

**Funkcje:**
- Ładowanie meta tagów SEO
- Importowanie CSS/JS
- Nawigacja Bootstrap
- Schema.org markup
- Open Graph tags

---

#### `footer.php` - Stopka strony

```php
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Malarz Trzebnica</h4>
                    <p>Precision, Perfection, Professional</p>
                </div>
                <div class="col-md-4">
                    <h5>Kontakt</h5>
                    <p>Tel: +48 452 690 824</p>
                    <p>Email: kontakt@malarz.trzebnica.pl</p>
                </div>
                <div class="col-md-4">
                    <h5>Usługi</h5>
                    <ul>
                        <li>Malowanie wnętrz</li>
                        <li>Malowanie elewacji</li>
                        <li>Szpachlowanie</li>
                        <li>Sucha zabudowa GK</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <p>&copy; <?php echo date('Y'); ?> Malarz Trzebnica. Wszelkie prawa zastrzeżone.</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- JavaScript -->
    <script src="<?php echo ASSETS_PATH; ?>/js/jquery-3.7.1.min.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>/js/custom.js"></script>
</body>
</html>
```

---

#### `config.php` - Konfiguracja globalna

```php
<?php
// Konfiguracja środowiska
define('ENVIRONMENT', 'production'); // production | development

// Dane strony
define('SITE_NAME', 'Malarz Trzebnica');
define('SITE_URL', 'https://www.malarz.trzebnica.pl');
define('SITE_EMAIL', 'kontakt@malarz.trzebnica.pl');
define('SITE_PHONE', '+48 452 690 824');
define('SITE_SLOGAN', 'Precision, Perfection, Professional');

// Ścieżki
define('BASE_PATH', __DIR__ . '/..');
define('ASSETS_PATH', SITE_URL . '/assets');
define('UPLOADS_PATH', BASE_PATH . '/uploads');

// Sesje
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Bezpieczeństwo
header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");

// Debugowanie
if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
?>
```

---

#### `functions.php` - Funkcje pomocnicze

```php
<?php
// Funkcje pomocnicze dla projektu Malarz Trzebnica

/**
 * Sanityzacja danych wejściowych
 */
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Walidacja email
 */
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Walidacja CSRF token
 */
function validate_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Wysyłanie emaila przez formularz kontaktowy
 */
function send_contact_email($name, $email, $phone, $message) {
    // Implementacja wysyłki (PHPMailer lub mail())
    // ...
}

/**
 * Generowanie meta tagów dla SEO
 */
function generate_meta_tags($title, $description, $keywords = []) {
    // ...
}
?>
```

---

### Katalog `assets/`

Zasoby statyczne podzielone na podkatalogi:

#### `css/` - Arkusze stylów
- **bootstrap.min.css** - Framework Bootstrap 5
- **style.css** - Niestandardowe style projektu
- **media.css** - Media queries (responsywność)
- **animate.min.css** - Biblioteka animacji CSS
- **swiper-bundle.min.css** - Swiper slider

#### `js/` - Skrypty JavaScript
- **jquery-3.7.1.min.js** - jQuery library
- **bootstrap.bundle.min.js** - Bootstrap JS + Popper
- **swiper-bundle.min.js** - Swiper slider
- **gsap.min.js** - Animacje GSAP
- **ScrollTrigger.min.js** - GSAP ScrollTrigger
- **custom.js** - Niestandardowe skrypty projektu
- **form-validation.js** - Walidacja formularzy

#### `image/` - Obrazy i grafiki
- **svg/** - Ikony SVG
- **home/** - Zdjęcia dla strony głównej
- **gallery/** - Zdjęcia galerii realizacji
- **logo/** - Logo firmy (różne rozmiary)

#### `font/` - Czcionki webowe
- **swap.css** - Google Fonts (Roboto, Open Sans)

---

### Plik `.htaccess`

Konfiguracja Apache:

```apache
# Friendly URLs (mod_rewrite)
RewriteEngine On
RewriteRule ^oferta/?$ oferta.php [L]
RewriteRule ^galeria/?$ galeria.php [L]
RewriteRule ^kontakt/?$ kontakt.php [L]

# Kompresja GZIP
AddOutputFilterByType DEFLATE text/html text/css text/javascript

# Cache headers
<FilesMatch "\.(css|js|jpg|png|webp)$">
    Header set Cache-Control "max-age=31536000, public"
</FilesMatch>

# Bezpieczeństwo
Header set X-Frame-Options "SAMEORIGIN"
Header set X-Content-Type-Options "nosniff"

# Blokada listowania katalogów
Options -Indexes
```

---

## 📂 Katalog źródłowy `src/`

Zawiera oryginalny szablon HTML Bootstrap (przed konwersją na PHP).

```
src/
├── index.html              # Oryginalny szablon
├── *.html                  # Inne strony szablonu
└── assets/                 # Oryginalne zasoby
    ├── css/
    ├── js/
    └── image/
```

**Uwaga:** To jest szablon referencyjny. Nie wdrażaj tego na produkcję!

---

## 📚 Dokumentacja `docs/`

Wszystkie pliki dokumentacji projektu:

| Plik | Opis |
|------|------|
| `INSTALACJA.md` | Instrukcja instalacji krok po kroku |
| `STRUKTURA.md` | Opis struktury (TEN PLIK) |
| `EDYCJA_TRESCI.md` | Jak edytować treści na stronie |
| `WYMAGANIA.md` | Wymagania techniczne serwera |
| `ARCHITEKTURA-MVC.md` | Architektura MVC (jeśli zaimplementowana) |
| `GALERIA-LIGHTBOX.md` | Implementacja galerii z lightbox |
| `SEO.md` | Strategia SEO dla lokalnej firmy |
| `BEZPIECZENSTWO.md` | Zabezpieczenia (XSS, CSRF, SQL Injection) |
| `DEPLOYMENT.md` | Instrukcja wdrożenia na produkcję |
| `CHANGELOG.md` | Historia zmian projektu |
| `API-DOCUMENTATION.md` | API formularza kontaktowego |

---

## ⚙️ GitHub Workflows `.github/workflows/`

Automatyczne procesy CI/CD:

| Workflow | Opis | Trigger |
|----------|------|---------|
| `php-lint.yml` | PHP syntax check, PSR-12, PHPStan | Push, PR |
| `deploy-production.yml` | Automatyczne wdrożenie FTP/SSH | Push do main |
| `lighthouse-ci.yml` | Testy wydajności, SEO, accessibility | Push, PR, Schedule |
| `backup.yml` | Cotygodniowe backupy repozytorium | Schedule (poniedziałki 3 AM) |

---

## 📊 Diagram architektury

### Architektura request flow

```
┌─────────────────────────────────────────────────────────────┐
│                       USER REQUEST                           │
│              https://www.malarz.trzebnica.pl/oferta          │
└────────────────────┬────────────────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────────────────┐
│                  APACHE .htaccess                            │
│  RewriteRule ^oferta/?$ oferta.php [L]                      │
└────────────────────┬────────────────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────────────────┐
│                   oferta.php                                 │
│  1. require_once 'includes/config.php'                      │
│  2. require_once 'includes/functions.php'                   │
│  3. include 'includes/header.php'                           │
│  4. <!-- Content -->                                         │
│  5. include 'includes/footer.php'                           │
└─────────────────────────────────────────────────────────────┘
                     │
                     ▼
┌─────────────────────────────────────────────────────────────┐
│                   HTML RESPONSE                              │
│  - Pełna strona HTML z header + content + footer            │
│  - CSS, JS, images z katalog assets/                        │
└─────────────────────────────────────────────────────────────┘
```

### Struktura modułowa

```
┌──────────────────────────────────────────────────────────────┐
│                         PAGE.php                              │
│  (index.php, oferta.php, galeria.php, kontakt.php)          │
└──────────┬─────────────────────────────────────┬─────────────┘
           │                                     │
           ▼                                     ▼
┌────────────────────────┐          ┌────────────────────────┐
│   includes/header.php  │          │  includes/footer.php   │
│  - <head> meta tags    │          │  - Stopka              │
│  - <header> nav        │          │  - Kontakt             │
│  - CSS imports         │          │  - JS imports          │
│  - Schema.org          │          │  - Copyright           │
└──────────┬─────────────┘          └────────────────────────┘
           │
           ▼
┌────────────────────────┐
│  includes/config.php   │
│  - Stałe konfiguracyjne│
│  - Sesje               │
│  - Security headers    │
└────────────────────────┘
           │
           ▼
┌────────────────────────┐
│ includes/functions.php │
│  - sanitize_input()    │
│  - validate_email()    │
│  - send_email()        │
└────────────────────────┘
```

---

## 🎨 Konwencje nazewnictwa

### Pliki PHP
- **snake_case**: `form_validation.php`, `send_email.php`
- **PascalCase dla klas**: `ContactForm.php`, `EmailService.php`

### Funkcje PHP
- **snake_case**: `sanitize_input()`, `validate_csrf_token()`

### CSS Classes
- **kebab-case**: `.hero-section`, `.contact-form`, `.nav-item`

### JavaScript
- **camelCase**: `validateForm()`, `submitContact()`

---

## 📞 Kontakt

W razie pytań o strukturę projektu:

- **Email:** kontakt@malarz.trzebnica.pl
- **Telefon:** +48 452 690 824
- **GitHub Issues:** [github.com/user/malarz-trzebnica-php/issues](https://github.com/user/malarz-trzebnica-php/issues)

---

**Malarz Trzebnica** - Precision, Perfection, Professional 🎨

Copyright © 2024-2025 Malarz Trzebnica. Wszystkie prawa zastrzeżone.

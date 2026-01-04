# Claude AI - Instrukcje dla Projektu Malarz Trzebnica

> Szczegolowe wytyczne dla asystenta Claude (Anthropic) do pracy z projektem PHP MVC firmy malarskiej

---

## Kontekst Projektu

### Informacje o Firmie
- **Nazwa:** Malarz Trzebnica
- **Branza:** Uslugi malarskie i wykonczeniowe
- **Strona:** www.malarz.trzebnica.pl
- **Telefon:** +48 452 690 824
- **Lokalizacja:** Trzebnica i okolice (Dolny Slask)
- **Slogan:** "Precyzja, Perfekcja, Profesjonalizm"

### Uslugi Firmy
1. Malowanie wnetrz (mieszkania, domy, biura)
2. Malowanie elewacji (budynki mieszkalne i komercyjne)
3. Szpachlowanie scian (przygotowanie powierzchni)
4. Sucha zabudowa GK (scianki dzialowe, sufity)
5. Ukladanie podlog (panele, wykladziny)
6. Glazura (kafelkowanie lazienek, kuchni)
7. Drobne elementy wykonczenia

### Stack Technologiczny
- **Backend:** PHP 7.4+
- **Frontend:** Bootstrap 5, jQuery, GSAP, Swiper.js
- **Architektura:** MVC (Model-View-Controller)
- **Serwer:** Apache z mod_rewrite
- **Pakiety:** Composer (PSR-4 autoloading)

---

## Struktura Projektu

```
malarz-trzebnica-php/
├── dist/                      # Pliki produkcyjne (GLOWNY KATALOG)
│   ├── index.php             # Strona glowna
│   ├── oferta.php            # Uslugi
│   ├── galeria.php           # Portfolio
│   ├── kontakt.php           # Formularz kontaktowy
│   ├── includes/
│   │   ├── header.php        # Naglowek (nav, meta)
│   │   ├── footer.php        # Stopka (scripts, contact)
│   │   └── config.php        # Konfiguracja
│   ├── app/
│   │   ├── Controllers/      # Kontrolery MVC
│   │   ├── Models/           # Modele danych
│   │   ├── Services/         # Logika biznesowa
│   │   └── Helpers/          # Funkcje pomocnicze
│   ├── assets/
│   │   ├── css/              # Style CSS
│   │   ├── js/               # Skrypty JS
│   │   └── images/           # Obrazy
│   └── uploads/              # Pliki uzytkownikow
│
├── src/                       # Zrodlowe szablony HTML
├── docs/                      # Dokumentacja
├── agents/                    # Agenci AI
└── .github/                   # GitHub config
```

---

## Zasady Pracy z Architektura MVC

### Kontrolery (Controllers)
```php
<?php
namespace App\Controllers;

class HomeController
{
    public function index(): void
    {
        $data = [
            'title' => 'Malarz Trzebnica - Profesjonalne Uslugi Malarskie',
            'description' => 'Firma malarska w Trzebnicy...',
            'services' => $this->getServices(),
        ];
        include __DIR__ . '/../../views/home.php';
    }
}
```

### Modele (Models)
```php
<?php
namespace App\Models;

class Service
{
    public string $name;
    public string $description;
    public string $icon;
    public float $priceFrom;
}
```

---

## Bezpieczenstwo - Wymagane Praktyki

### 1. Walidacja Danych
```php
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$phone = preg_replace('/[^0-9+]/', '', $_POST['phone'] ?? '');
```

### 2. Ochrona XSS
```php
echo htmlspecialchars($userInput, ENT_QUOTES, 'UTF-8');
```

### 3. Tokeny CSRF
```php
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
    die('Nieprawidlowy token CSRF');
}
```

### 4. Honeypot Anti-Spam
```php
if (!empty($_POST['website'])) {
    exit; // Bot wykryty
}
```

---

## SEO - Wymagane Elementy

### Meta Tagi
```html
<title>Malarz Trzebnica - Profesjonalne Uslugi Malarskie</title>
<meta name="description" content="Firma malarska w Trzebnicy. Malowanie wnetrz, elewacji. Tel: +48 452 690 824">
<meta name="keywords" content="malarz Trzebnica, uslugi malarskie, malowanie wnetrz">
```

### Open Graph
```html
<meta property="og:title" content="Malarz Trzebnica - Uslugi Malarskie">
<meta property="og:description" content="Profesjonalne uslugi malarskie w Trzebnicy">
<meta property="og:url" content="https://www.malarz.trzebnica.pl">
<meta property="og:type" content="website">
```

### Schema.org LocalBusiness
```json
{
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "Malarz Trzebnica",
    "telephone": "+48 452 690 824",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "Trzebnica",
        "addressCountry": "PL"
    }
}
```

---

## Przyklady Promptow dla Projektu

### 1. Tworzenie Kontrolera
```
Stworz kontroler ContactController.php dla formularza kontaktowego.
Wymagania: walidacja pol, token CSRF, honeypot, PHPMailer, JSON response.
```

### 2. Optymalizacja Widoku
```
Zoptymalizuj widok galeria.php: lazy loading, lightbox Swiper.js, 
filtrowanie kategorii, paginacja, dostepnosc WCAG.
```

### 3. Komponenty Bootstrap
```
Stworz komponent PHP dla sekcji uslug. Bootstrap 5 grid,
karty z ikonami Font Awesome, hover effects, mobile-first.
```

### 4. Formularz AJAX
```
Formularz kontaktowy AJAX: walidacja client/server,
animowany feedback, reCAPTCHA v3, zapis lub email.
```

---

## Styl Kodu PHP

- PSR-12 coding standard
- Klasy: PascalCase
- Metody/funkcje: camelCase
- Zmienne: camelCase
- Stale: UPPER_SNAKE_CASE

---

## Kontekst dla Claude

1. **Jezyk:** Tresci po polsku, kod po angielsku
2. **Telefon:** +48 452 690 824
3. **Lokalizacja:** Trzebnica, Dolny Slask
4. **Branza:** Uslugi malarskie i wykonczeniowe
5. **Klienci:** Lokalni, indywidualni i firmy
6. **Styl:** Profesjonalny, zaufany, lokalny

---

## Polecenia

```
@claude Przeanalizuj strukture MVC w dist/
@claude Stworz kontroler dla [funkcjonalnosc]
@claude Zoptymalizuj [plik].php pod SEO
@claude Dodaj walidacje do formularza
@claude Przegladnij kod pod katem bezpieczenstwa
```

---

**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm

*Instrukcje zaktualizowane: Styczen 2025*

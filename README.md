# Malarz Trzebnica - Strona Firmowa

> **Precyzja, Perfekcja, Profesjonalizm**

Profesjonalna strona internetowa dla firmy malarskiej z Trzebnicy. Projekt oparty na architekturze MVC z wykorzystaniem PHP, Bootstrap 5 i nowoczesnych technologii webowych.

## O Projekcie

Strona internetowa dla firmy **Malarz Trzebnica** oferującej kompleksowe uslugi malarskie i wykonczeniowe:

- **Malowanie wnetrz** - mieszkania, domy, biura
- **Malowanie elewacji** - budynki mieszkalne i komercyjne
- **Szpachlowanie scian** - profesjonalne przygotowanie powierzchni
- **Sucha zabudowa GK** - scianki dzialowe, sufity podwieszane
- **Ukladanie podlog** - panele, wykładziny
- **Glazura** - plytkowanie łazienek i kuchni
- **Elementy wykonczenia** - drobne prace remontowe

## Dane Kontaktowe

- **Strona:** [www.malarz.trzebnica.pl](https://www.malarz.trzebnica.pl)
- **Telefon:** +48 452 690 824
- **Lokalizacja:** Trzebnica i okolice

## Struktura Projektu

```
malarz-trzebnica-php/
├── dist/                    # Pliki produkcyjne (PHP MVC)
│   ├── index.php           # Strona glowna
│   ├── oferta.php          # Uslugi
│   ├── galeria.php         # Portfolio realizacji
│   ├── kontakt.php         # Formularz kontaktowy
│   ├── includes/           # Komponenty PHP
│   │   ├── header.php      # Naglowek strony
│   │   ├── footer.php      # Stopka strony
│   │   └── config.php      # Konfiguracja
│   ├── assets/             # Zasoby statyczne
│   │   ├── css/            # Arkusze stylow
│   │   ├── js/             # Skrypty JavaScript
│   │   └── images/         # Obrazy i grafiki
│   └── uploads/            # Pliki uzytkownikow
│
├── src/                     # Pliki zrodlowe (HTML template)
│   ├── *.html              # Szablony HTML Bootstrap
│   └── assets/             # Oryginalne zasoby
│
├── docs/                    # Dokumentacja
│   └── *.md                # Pliki dokumentacji
│
├── .github/                 # Konfiguracja GitHub
│   ├── workflows/          # GitHub Actions CI/CD
│   ├── agents/             # Definicje agentow AI
│   └── prompts/            # Szablony promptow
│
├── agents/                  # Agenci AI (lokalne kopie)
├── prompts/                 # Prompty (lokalne kopie)
├── collections/             # Kolekcje GitHub Copilot
│
├── .gitignore              # Wykluczenia Git
├── .editorconfig           # Standardy formatowania
├── .htaccess               # Konfiguracja Apache
├── composer.json           # Zaleznosci PHP
├── LICENSE                 # Licencja projektu
├── README.md               # Ten plik
├── CONFIG-FILE.md          # Mapa generowania plikow
└── INFO-FILE.md            # Specyfikacja projektu
```

## Technologie

### Frontend
- **HTML5** - semantyczna struktura
- **CSS3** - stylowanie i animacje
- **Bootstrap 5** - responsywny framework
- **JavaScript (ES6+)** - interaktywnosc
- **jQuery** - manipulacja DOM
- **Swiper.js** - karuzele i slidery
- **GSAP** - zaawansowane animacje
- **Font Awesome 7** - ikony

### Backend
- **PHP 7.4+** - logika serwerowa
- **Composer** - zarzadzanie zaleznosciami
- **PSR-4** - autoloading
- **PHPMailer** - obsluga formularzy

### Narzedzia
- **Git** - kontrola wersji
- **GitHub Actions** - CI/CD
- **Composer** - pakiety PHP
- **npm** (opcjonalnie) - pakiety JS

## Szybki Start

### Wymagania
- PHP 7.4 lub nowszy
- Serwer Apache z mod_rewrite
- Composer

### Instalacja

1. **Klonowanie repozytorium:**
   ```bash
   git clone https://github.com/user/malarz-trzebnica-php.git
   cd malarz-trzebnica-php
   ```

2. **Instalacja zaleznosci PHP:**
   ```bash
   composer install
   ```

3. **Konfiguracja serwera:**
   - Ustaw `dist/` jako document root
   - Wlacz mod_rewrite w Apache
   - Skonfiguruj plik `.htaccess`

4. **Konfiguracja aplikacji:**
   ```bash
   cp dist/includes/config.example.php dist/includes/config.php
   # Edytuj config.php z wlasnymi ustawieniami
   ```

5. **Uruchomienie lokalnie:**
   ```bash
   php -S localhost:8000 -t dist/
   ```
   Otworz przegladarke: http://localhost:8000

## Dokumentacja

| Dokument | Opis |
|----------|------|
| [CONFIG-FILE.md](CONFIG-FILE.md) | Mapa generowania wszystkich plikow projektu |
| [INFO-FILE.md](INFO-FILE.md) | Szczegolowa specyfikacja zadania |
| [docs/INSTALACJA.md](docs/INSTALACJA.md) | Instrukcja instalacji |
| [docs/STRUKTURA.md](docs/STRUKTURA.md) | Architektura MVC |
| [docs/EDYCJA_TRESCI.md](docs/EDYCJA_TRESCI.md) | Edycja zawartosci |
| [docs/SEO.md](docs/SEO.md) | Optymalizacja SEO |
| [docs/BEZPIECZENSTWO.md](docs/BEZPIECZENSTWO.md) | Zabezpieczenia |

## Funkcjonalnosci

### Strony
- **Strona glowna** - prezentacja firmy, uslugi, portfolio
- **Oferta** - szczegolowy opis uslug malarskich
- **Galeria** - portfolio zrealizowanych projektow
- **Kontakt** - formularz kontaktowy z walidacja

### Cechy
- Responsywny design (mobile-first)
- Optymalizacja SEO (meta tagi, Schema.org)
- Formularz kontaktowy z zabezpieczeniami
- Galeria z lightbox
- Animacje scroll-triggered
- Lazy loading obrazow
- Kompresja GZIP
- Cache przegladarki

## Bezpieczenstwo

Projekt implementuje:
- Walidacja danych po stronie serwera (PHP)
- Ochrona przed XSS (htmlspecialchars)
- Tokeny CSRF w formularzach
- Ochrona przed spamem (honeypot)
- Naglowki bezpieczenstwa (CSP, X-Frame-Options)
- Przekierowanie HTTP na HTTPS

## SEO

- Zoptymalizowane meta tagi
- Open Graph dla mediow spolecznosciowych
- Schema.org LocalBusiness markup
- Sitemap.xml
- Robots.txt
- Czyste URL-e (friendly URLs)

## Wsparcie

W razie pytan lub problemow:
- **Telefon:** +48 452 690 824
- **Email:** kontakt@malarz.trzebnica.pl
- **Issues:** [GitHub Issues](https://github.com/user/malarz-trzebnica-php/issues)

## Licencja

Ten projekt jest objety licencja MIT - szczegoly w pliku [LICENSE](LICENSE).

---

**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm

Copyright 2024-2025 Malarz Trzebnica. Wszelkie prawa zastrzezone.

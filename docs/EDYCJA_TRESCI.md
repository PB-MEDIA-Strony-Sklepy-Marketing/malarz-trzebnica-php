# Edycja Treści - Malarz Trzebnica

Przewodnik edycji treści na stronie **www.malarz.trzebnica.pl**

---

## 📋 Spis treści

1. [Edycja tekstów na stronach](#edycja-tekstów-na-stronach)
2. [Dodawanie zdjęć do galerii](#dodawanie-zdjęć-do-galerii)
3. [Zarządzanie portfolio](#zarządzanie-portfolio)
4. [Edycja danych kontaktowych](#edycja-danych-kontaktowych)
5. [Zmiana meta tagów SEO](#zmiana-meta-tagów-seo)
6. [Optymalizacja obrazów](#optymalizacja-obrazów)

---

## ✏️ Edycja tekstów na stronach

### Strona główna (`dist/index.php`)

#### 1. Hero Section - Główny nagłówek

**Lokalizacja:** Linie 40-50

```php
<section class="hero">
    <h1>Malarz Trzebnica</h1>
    <p class="slogan">Precision, Perfection, Professional</p>
    <p class="description">
        Profesjonalne usługi malarskie w Trzebnicy i okolicach.
        Specjalizujemy się w malowaniu wnętrz, elewacji, szpachlow anni oraz suchej zabudowie GK.
    </p>
    <a href="kontakt.php" class="btn btn-primary">Skontaktuj się z nami</a>
</section>
```

**Co możesz zmienić:**
- Slogan firmy (obecnie: "Precision, Perfection, Professional")
- Opis główny pod sloganem
- Tekst przycisku CTA

---

#### 2. Sekcja "O nas"

**Lokalizacja:** Linie 80-120

```php
<section class="about">
    <h2>O Firmie</h2>
    <p>
        Malarz Trzebnica to profesjonalna firma świadcząca kompleksowe usługi malarskie
        i wykończeniowe. Dysponujemy nowoczesnym sprzętem i doświadczonym zespołem.
    </p>
    <ul class="features">
        <li>✓ Profesjonalny sprzęt</li>
        <li>✓ Doświadczony zespół</li>
        <li>✓ Gwarancja jakości</li>
        <li>✓ Terminowość</li>
    </ul>
</section>
```

**Co możesz zmienić:**
- Opis firmy
- Lista cech wyróżniających
- Dodać/usunąć punkty

---

### Strona Oferta (`dist/oferta.php`)

#### Edycja opisu usług

**Lokalizacja:** Linie 30-200

```php
<div class="service-card">
    <h3>Malowanie wnętrz</h3>
    <p>
        Profesjonalne malowanie mieszkań, domów i biur. Używamy najwyższej jakości farb
        i materiałów. Dokładne przygotowanie powierzchni przed malowaniem.
    </p>
    <ul>
        <li>Pokoje, salony, sypialne</li>
        <li>Kuchnie i łazienki</li>
        <li>Biura i przestrzenie komercyjne</li>
    </ul>
</div>
```

**Jak edytować:**

1. Otwórz plik `dist/oferta.php` w edytorze tekstowym
2. Znajdź sekcję z opisem usługi (np. "Malowanie wnętrz")
3. Zmień tekst w tagach `<p>` i `<li>`
4. Zapisz plik
5. Odśwież stronę w przeglądarce

**Struktura opisu usługi:**
```
Nagłówek (<h3>) → Opis główny (<p>) → Lista szczegółów (<ul><li>)
```

---

#### Dodawanie nowej usługi

Skopiuj blok kodu istniejącej usługi:

```php
<!-- Nowa usługa: Tynkowanie -->
<div class="service-card">
    <img src="assets/image/services/tynkowanie.jpg" alt="Tynkowanie" class="service-img">
    <h3>Tynkowanie ścian</h3>
    <p>
        Profesjonalne nakładanie tynków gipsowych i cementowych.
        Wyrównywanie ścian przed malowaniem.
    </p>
    <ul>
        <li>Tynki gipsowe</li>
        <li>Tynki cementowe</li>
        <li>Gładzie gipsowe</li>
    </ul>
    <a href="kontakt.php" class="btn btn-secondary">Zapytaj o wycenę</a>
</div>
```

---

### Strona Kontakt (`dist/kontakt.php`)

#### Edycja danych kontaktowych

**Lokalizacja:** Linie 50-80

```php
<div class="contact-info">
    <h3>Dane kontaktowe</h3>
    
    <div class="contact-item">
        <i class="fa fa-phone"></i>
        <a href="tel:+48452690824">+48 452 690 824</a>
    </div>
    
    <div class="contact-item">
        <i class="fa fa-envelope"></i>
        <a href="mailto:kontakt@malarz.trzebnica.pl">kontakt@malarz.trzebnica.pl</a>
    </div>
    
    <div class="contact-item">
        <i class="fa fa-map-marker"></i>
        <span>Trzebnica i okolice</span>
    </div>
    
    <div class="contact-item">
        <i class="fa fa-clock"></i>
        <span>Pon-Pt: 8:00-18:00, Sob: 9:00-14:00</span>
    </div>
</div>
```

**Co możesz zmienić:**
- Numer telefonu
- Adres email
- Lokalizację
- Godziny otwarcia

---

## 📷 Dodawanie zdjęć do galerii

### Krok 1: Przygotowanie zdjęć

#### A. Wymagania techniczne

| Parametr | Zalecana wartość |
|----------|------------------|
| **Format** | JPG lub WebP |
| **Rozdzielczość** | Max 1920x1080 px |
| **Rozmiar pliku** | Max 500 KB |
| **Proporcje** | 16:9 lub 4:3 |
| **Nazewnictwo** | `kategoria-opis-01.jpg` |

#### B. Optymalizacja zdjęć

**Online (darmowe narzędzia):**
- [TinyPNG](https://tinypng.com/) - kompresja PNG/JPG
- [Squoosh](https://squoosh.app/) - Google, WebP converter
- [Compressor.io](https://compressor.io/) - kompresja bez straty jakości

**Offline (programy):**
- **Photoshop:** File → Export → Save for Web (Jpeg, Quality 80%)
- **GIMP:** Export As → JPEG (Quality 85%)
- **IrfanView:** Image → Resize → 1920px width, Save Quality 85%

**Przykładowe nazwy plików:**
```
wnetrza-salon-nowoczesny-01.jpg
elewacja-budynek-mieszkalny-02.jpg
detale-sciana-szpachlowanie-03.jpg
```

---

### Krok 2: Upload zdjęć na serwer

#### Opcja A: FTP (FileZilla, Cyberduck)

1. Połącz się z serwerem FTP
   - Host: `ftp.malarz.trzebnica.pl`
   - User: `twoj-login`
   - Password: `twoje-haslo`

2. Przejdź do katalogu: `/public_html/assets/image/gallery/`

3. Struktura katalogów:
   ```
   gallery/
   ├── wnetrza/         # Wnętrza mieszkalne
   ├── elewacje/        # Elewacje budynków
   └── detale/          # Detale wykończeniowe
   ```

4. Upload plików do odpowiedniego katalogu

---

#### Opcja B: Panel hostingowy (cPanel/Plesk)

1. Zaloguj się do panelu cPanel
2. File Manager → `public_html/assets/image/gallery/`
3. Kliknij "Upload"
4. Wybierz pliki i upload

---

#### Opcja C: SSH/SFTP

```bash
# Połącz się przez SFTP
sftp user@malarz.trzebnica.pl

# Przejdź do katalogu galerii
cd /var/www/html/assets/image/gallery/wnetrza/

# Upload pliku
put salon-01.jpg

# Upload wielu plików
mput *.jpg
```

---

### Krok 3: Dodanie zdjęć do galerii

Edytuj plik `dist/galeria.php`:

```php
<!-- Kategoria: Wnętrza -->
<div class="gallery-category" id="wnetrza">
    <h2>Wnętrza mieszkalne</h2>
    
    <div class="gallery-grid">
        
        <!-- Zdjęcie 1 -->
        <div class="gallery-item">
            <a href="assets/image/gallery/wnetrza/salon-01.jpg" 
               data-lightbox="wnetrza" 
               data-title="Salon - malowanie ścian">
                <img src="assets/image/gallery/wnetrza/salon-01.jpg" 
                     alt="Malowanie salonu Trzebnica"
                     loading="lazy">
            </a>
            <p class="photo-caption">Salon - malowanie ścian</p>
        </div>
        
        <!-- Zdjęcie 2 - NOWE ZDJĘCIE -->
        <div class="gallery-item">
            <a href="assets/image/gallery/wnetrza/sypialnia-01.jpg" 
               data-lightbox="wnetrza" 
               data-title="Sypialnia - eleganckie wykończenie">
                <img src="assets/image/gallery/wnetrza/sypialnia-01.jpg" 
                     alt="Malowanie sypialni Trzebnica"
                     loading="lazy">
            </a>
            <p class="photo-caption">Sypialnia - eleganckie wykończenie</p>
        </div>
        
        <!-- Dodaj więcej zdjęć tutaj -->
        
    </div>
</div>
```

**Co wypełnić:**
- `href` - ścieżka do pełnego zdjęcia
- `data-lightbox` - kategoria (wnetrza/elewacje/detale)
- `data-title` - tytuł w lightbox
- `src` - ścieżka do thumbnail (to samo co href)
- `alt` - opis dla SEO
- `loading="lazy"` - lazy loading (nie zmieniaj)

---

## 🎨 Zarządzanie portfolio

### Wyróżnione realizacje na stronie głównej

**Lokalizacja:** `dist/index.php` (linie 200-250)

```php
<section class="portfolio-highlight">
    <h2>Nasze Realizacje</h2>
    
    <div class="portfolio-grid">
        
        <!-- Realizacja 1 -->
        <div class="portfolio-item">
            <img src="assets/image/portfolio/projekt-01.jpg" alt="Realizacja 1">
            <div class="portfolio-overlay">
                <h3>Dom jednorodzinny - Trzebnica</h3>
                <p>Malowanie wnętrz | Szpachlowanie | GK</p>
                <a href="galeria.php#wnetrza" class="btn-view">Zobacz więcej</a>
            </div>
        </div>
        
        <!-- Realizacja 2 - DODAJ NOWĄ -->
        <div class="portfolio-item">
            <img src="assets/image/portfolio/projekt-02.jpg" alt="Realizacja 2">
            <div class="portfolio-overlay">
                <h3>Mieszkanie 3-pokojowe - Wrocław</h3>
                <p>Kompleksowe wykończenie</p>
                <a href="galeria.php#wnetrza" class="btn-view">Zobacz więcej</a>
            </div>
        </div>
        
    </div>
</section>
```

---

### Opisy realizacji

Dla każdej realizacji możesz dodać:
- **Tytuł:** Nazwa projektu (np. "Dom jednorodzinny - Trzebnica")
- **Lokalizacja:** Miasto lub dzielnica
- **Zakres:** Jakie usługi wykonano
- **Czas realizacji:** Ile dni/tygodni trwała
- **Materiały:** Jakie farby/materiały użyto

---

## 📞 Edycja danych kontaktowych

### W pliku konfiguracyjnym

**Plik:** `dist/includes/config.php`

```php
// Dane kontaktowe
define('SITE_PHONE', '+48 452 690 824');
define('SITE_EMAIL', 'kontakt@malarz.trzebnica.pl');
define('SITE_ADDRESS', 'Trzebnica i okolice');
define('SITE_HOURS', 'Pon-Pt: 8:00-18:00, Sob: 9:00-14:00');
```

Po zmianie tych wartości, dane będą automatycznie aktualizowane w:
- Stopce (footer.php)
- Stronie kontakt (kontakt.php)
- Schema.org markup (SEO)

---

### W stopce (footer.php)

**Plik:** `dist/includes/footer.php`

```php
<footer>
    <div class="footer-contact">
        <h4>Kontakt</h4>
        <p>
            <i class="fa fa-phone"></i> 
            <a href="tel:<?php echo SITE_PHONE; ?>"><?php echo SITE_PHONE; ?></a>
        </p>
        <p>
            <i class="fa fa-envelope"></i> 
            <a href="mailto:<?php echo SITE_EMAIL; ?>"><?php echo SITE_EMAIL; ?></a>
        </p>
        <p>
            <i class="fa fa-map-marker"></i> 
            <?php echo SITE_ADDRESS; ?>
        </p>
    </div>
</footer>
```

---

## 🔍 Zmiana meta tagów SEO

### Dla pojedynczej strony

**W każdym pliku PHP (index.php, oferta.php, etc.):**

```php
<?php
$page_title = "Malarz Trzebnica - Profesjonalne Usługi Malarskie";
$page_description = "Kompleksowe usługi malarskie w Trzebnicy. Malowanie wnętrz, elewacji, szpachlowanie, sucha zabudowa GK. Telefon: +48 452 690 824";
$page_keywords = "malarz trzebnica, usługi malarskie trzebnica, malowanie wnętrz, malowanie elewacji, szpachlowanie";

include 'includes/header.php';
?>
```

---

### Meta tagi dla każdej strony

| Strona | Tytuł | Opis |
|--------|-------|------|
| **Strona główna** | "Malarz Trzebnica - Precision, Perfection, Professional" | "Profesjonalne usługi malarskie w Trzebnicy i okolicach. Malowanie wnętrz i elewacji, szpachlowanie ścian, sucha zabudowa GK, układanie podłóg i glazury." |
| **Oferta** | "Oferta - Usługi Malarskie Trzebnica" | "Pełna oferta usług malarskich i wykończeniowych: malowanie wnętrz i elewacji, szpachlowanie, GK, podłogi, glazura. Darmowa wycena. Tel: +48 452 690 824" |
| **Galeria** | "Galeria Realizacji - Malarz Trzebnica" | "Zobacz nasze zrealizowane projekty. Galeria zdjęć wykonanych prac malarskich: wnętrza mieszkalne, elewacje budynków, detale wykończeniowe." |
| **Kontakt** | "Kontakt - Malarz Trzebnica" | "Skontaktuj się z nami! Telefon: +48 452 690 824, Email: kontakt@malarz.trzebnica.pl. Darmowa wycena usług malarskich. Trzebnica i okolice." |

---

## 🖼️ Optymalizacja obrazów

### Kompresja masowa

**Online:**
```bash
# Bulk Image Compressor
https://bulkresizephotos.com/

# Kraken.io (do 1MB za darmo)
https://kraken.io/web-interface
```

**Offline (skrypt):**
```bash
# ImageMagick - kompresja wszystkich JPG
for file in *.jpg; do
    convert "$file" -quality 85 -resize 1920x1080\> "optimized-$file"
done

# WebP conversion
for file in *.jpg; do
    cwebp -q 85 "$file" -o "${file%.jpg}.webp"
done
```

---

### Lazy loading obrazów

Wszystkie obrazy galerii powinny mieć atrybut `loading="lazy"`:

```html
<img src="assets/image/gallery/zdjecie.jpg" 
     alt="Opis zdjęcia" 
     loading="lazy">
```

To opóźnia ładowanie obrazów poza ekranem, przyspieszając stronę.

---

## 📝 Szybki checklist edycji

- [ ] Przygotowałem zdjęcia (max 500 KB, 1920px)
- [ ] Zoptymalizowałem obrazy (TinyPNG/Squoosh)
- [ ] Nadałem sensowne nazwy plików
- [ ] Uploadowałem na serwer do właściwego katalogu
- [ ] Dodałem kod HTML w galeria.php
- [ ] Wypełniłem atrybuty alt dla SEO
- [ ] Dodałem loading="lazy"
- [ ] Przetestowałem stronę w przeglądarce
- [ ] Sprawdziłem responsywność (mobile)
- [ ] Sprawdziłem lightbox (kliknięcie w zdjęcie)

---

## 📞 Pomoc

W razie problemów:

- **Email:** kontakt@malarz.trzebnica.pl
- **Telefon:** +48 452 690 824
- **Dokumentacja:** `docs/` w repozytorium

---

**Malarz Trzebnica** - Precision, Perfection, Professional 🎨

Copyright © 2024-2025 Malarz Trzebnica. Wszystkie prawa zastrzeżone.

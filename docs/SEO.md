# Strategia SEO - Malarz Trzebnica

## 1. Wstęp

Dokument opisuje kompletną strategię SEO dla strony **www.malarz.trzebnica.pl** firmy malarskiej. Fokus na optymalizacji dla lokalnych wyszukiwań i słów kluczowych "malarz Trzebnica".

### Cele SEO:
1. 📍 Ranking #1 dla "malarz Trzebnica" na Google
2. 🌐 Widoczność w lokalnych wynikach wyszukiwania
3. 📱 Optymalizacja dla urządzeń mobilnych
4. 🎯 Zdobycie klientów lokalnych
5. 📊 Zwiększenie ruchu organicznego o 150% w 6 miesięcy

---

## 2. Słowa Kluczowe

### 2.1 Słowa Kluczowe Główne

| Słowo Kluczowe | Wyszukiwania/miesiąc | Trudność | Priorytet |
|---|---|---|---|
| malarz Trzebnica | 390 | Wysoka | ⭐⭐⭐⭐⭐ |
| malowanie wnętrz Trzebnica | 210 | Wysoka | ⭐⭐⭐⭐⭐ |
| malarz-elewacji Trzebnica | 140 | Średnia | ⭐⭐⭐⭐ |
| szpachlowanie Trzebnica | 120 | Średnia | ⭐⭐⭐⭐ |
| glazura Trzebnica | 85 | Średnia | ⭐⭐⭐ |
| malowanie domów Trzebnica | 95 | Wysoka | ⭐⭐⭐⭐ |

### 2.2 Słowa Kluczowe Long-Tail

```
- Usługi malarskie Trzebnica
- Malarz do pracy na czarno
- Tapetowanie i malowanie Trzebnica
- Profesjonalne malowanie ścian
- Malarz pokojowy w Trzebnicy
- Szpachlowanie i gruntowanie
- Gips kartonowe sufity Trzebnica
- Glazurka łazienkowa Trzebnica
- Podłogi drewniane Trzebnica
- Elewacje malarskie Trzebnica
```

### 2.3 Słowa Kluczowe Semantyczne (LSI Keywords)

```
- Usługi malarskie, malarstwo, malarz-profesjonalista
- Malowanie wnętrz, pokojów, pomieszczeń, domów
- Prace wykończeniowe, remonty, modernizacja
- Szpachlowanie ścian, wyrównywanie, grunty
- Glazurowanie, kafelkowanie, hydroizolacja
- Precyzja, profesjonalizm, jakość
```

### 2.4 Słowa Kluczowe Lokalne

```
- Trzebnica (miasto, gmina)
- Województwo wielkopolskie
- Woj. Wielkopolskie
- Powiat trzebnicko-oława
- Okolice Trzebnicy
- Centrum Trzebnicy
```

---

## 3. On-Page SEO

### 3.1 Struktura Tagów HTML

#### Strona Główna

**Plik: src/Views/home.php**

```php
<?php
$title = "Malarz Trzebnica - Profesjonalne Usługi Malarskie";
$description = "Malarz Trzebnica ✓ Malowanie wnętrz i elewacji ✓ Szpachlowanie ✓ Glazura ✓ Gładź gipsowa. Precision, Perfection, Professional. Tel: +48 452 690 824";
$keywords = "malarz Trzebnica, malowanie wnętrz, szpachlowanie, glazura, usługi malarskie";
$canonical = "https://www.malarz.trzebnica.pl";
$og_image = "https://www.malarz.trzebnica.pl/assets/images/og-image.jpg";
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Meta Description (160 znaków) -->
    <meta name="description" 
          content="<?php echo htmlspecialchars($description); ?>">
    
    <!-- Keywords (deprecated ale polecane dla local SEO) -->
    <meta name="keywords" 
          content="<?php echo htmlspecialchars($keywords); ?>">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical); ?>">
    
    <!-- Open Graph (Facebook, LinkedIn) -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonical); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($description); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($og_image); ?>">
    <meta property="og:site_name" content="Malarz Trzebnica">
    <meta property="og:locale" content="pl_PL">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($description); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($og_image); ?>">
    
    <!-- Local Business Meta (Google) -->
    <meta name="geo.position" content="51.6075;17.7050">
    <meta name="ICBM" content="51.6075, 17.7050">
    <meta name="geo.placename" content="Trzebnica, Polska">
    
    <title><?php echo htmlspecialchars($title); ?></title>
</head>
<body>
    <!-- ... reszta HTML ... -->
</body>
</html>
```

#### Strony Usług

**Plik: src/Views/o-uslugach.php**

```php
<?php
$pageType = $_GET['usluga'] ?? 'wszystkie';

$metaTags = [
    'malowanie-wnetrz' => [
        'title' => 'Malowanie Wnętrz Trzebnica - Profesjonalne Usługi',
        'description' => 'Profesjonalne malowanie wnętrz w Trzebnicy. Pokoje, salony, biura. Gwarancja jakości. Tel: +48 452 690 824',
        'keywords' => 'malowanie wnętrz Trzebnica, malowanie pokojów, malowanie domów',
    ],
    'szpachlowanie' => [
        'title' => 'Szpachlowanie Ścian Trzebnica - Usługi Malarskie',
        'description' => 'Szpachlowanie i wyrównywanie ścian w Trzebnicy. Profesjonalnie i szybko. Tel: +48 452 690 824',
        'keywords' => 'szpachlowanie Trzebnica, wyrównywanie ścian, grunty',
    ],
    'glazura' => [
        'title' => 'Glazura i Kafelkowanie Trzebnica',
        'description' => 'Usługi glazurowania i kafelkowania łazienek w Trzebnicy. Profesjonalna jakość. Tel: +48 452 690 824',
        'keywords' => 'glazura Trzebnica, kafelkowanie, hydroizolacja',
    ],
];

$current = $metaTags[$pageType] ?? $metaTags['malowanie-wnetrz'];
$title = $current['title'];
$description = $current['description'];
$keywords = $current['keywords'];
?>

<head>
    <meta name="description" content="<?php echo htmlspecialchars($description); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($keywords); ?>">
    <title><?php echo htmlspecialchars($title); ?></title>
</head>
```

### 3.2 Struktura H1-H6

```html
<!-- Poprawna hierarchia nagłówków -->

<h1>Malarz Trzebnica - Precision, Perfection, Professional</h1>
<!-- Powinien być TYLKO jeden H1 na stronie! -->

<h2>Usługi Malarskie</h2>
<h3>Malowanie Wnętrz</h3>
<h3>Szpachlowanie Ścian</h3>

<h2>Portfolio Naszych Prac</h2>
<h3>Kategoria: Malowanie Wnętrz</h3>

<h2>Kontakt</h2>
```

### 3.3 ALT Tekst dla Obrazów

```php
<!-- ❌ ZŁE -->
<img src="projekt.jpg">

<!-- ✅ DOBRE -->
<img src="projekt.jpg" 
     alt="Malowanie salonu domu w Trzebnicy - przed i po"
     title="Projekt: Malowanie wnętrz">

<!-- ✅ BARDZO DOBRE (responsywne) -->
<img src="projekt-thumb.jpg"
     srcset="projekt-thumb.jpg 400w, projekt-full.jpg 1200w"
     sizes="(max-width: 768px) 100vw, (max-width: 1200px) 50vw, 33vw"
     alt="Profesjonalne malowanie wnętrz - Trzebnica"
     loading="lazy">
```

### 3.4 Schema.org Markup

#### LocalBusiness Schema

**Plik: src/Views/layouts/header.php (w head)**

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Malarz Trzebnica",
  "image": "https://www.malarz.trzebnica.pl/assets/images/logo.png",
  "description": "Profesjonalne usługi malarskie i wykończeniowe w Trzebnicy",
  "url": "https://www.malarz.trzebnica.pl",
  "telephone": "+48452690824",
  "email": "kontakt@malarz.trzebnica.pl",
  "priceRange": "$$$",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "ul. Beispielstraße 123",
    "addressLocality": "Trzebnica",
    "postalCode": "55-100",
    "addressCountry": "PL"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "51.6075",
    "longitude": "17.7050"
  },
  "areaServed": {
    "@type": "City",
    "name": "Trzebnica, Wielkopolskie, Polska"
  },
  "openingHoursSpecification": [
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": "Monday",
      "opens": "08:00",
      "closes": "18:00"
    },
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": ["Tuesday", "Wednesday", "Thursday", "Friday"],
      "opens": "08:00",
      "closes": "18:00"
    },
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": "Saturday",
      "opens": "09:00",
      "closes": "14:00"
    },
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": "Sunday",
      "opens": "",
      "closes": ""
    }
  ],
  "sameAs": [
    "https://www.facebook.com/malarz-trzebnica",
    "https://www.google.com/search?q=malarz+trzebnica"
  ],
  "founder": {
    "@type": "Person",
    "name": "Jan Kowalski"
  }
}
</script>
```

#### Service Schema

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Malowanie Wnętrz",
  "description": "Profesjonalne malowanie pomieszczeń mieszkalnych",
  "provider": {
    "@type": "LocalBusiness",
    "name": "Malarz Trzebnica",
    "url": "https://www.malarz.trzebnica.pl"
  },
  "areaServed": {
    "@type": "City",
    "name": "Trzebnica"
  },
  "availableLanguage": "pl"
}
</script>
```

#### Organization Schema

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Malarz Trzebnica",
  "alternateName": "Usługi Malarskie",
  "url": "https://www.malarz.trzebnica.pl",
  "logo": "https://www.malarz.trzebnica.pl/assets/images/logo.png",
  "description": "Usługi malarskie, szpachlowania i wykończeniowe w Trzebnicy",
  "sameAs": [
    "https://www.facebook.com/malarz-trzebnica",
    "https://www.instagram.com/malarz_trzebnica"
  ],
  "contactPoint": {
    "@type": "ContactPoint",
    "contactType": "Sales",
    "telephone": "+48-452-690-824",
    "email": "kontakt@malarz.trzebnica.pl"
  }
}
</script>
```

---

## 4. Technical SEO

### 4.1 robots.txt

**Plik: public/robots.txt**

```
User-agent: *
Allow: /
Disallow: /admin/
Disallow: /private/
Disallow: /storage/
Disallow: /*.json$
Disallow: /*.xml$

# Sitemap
Sitemap: https://www.malarz.trzebnica.pl/sitemap.xml

# Delay dla crawlerów (opcjonalnie)
Crawl-delay: 1
Request-rate: 1/1s
```

### 4.2 Sitemap.xml

**Plik: public/sitemap.xml**

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0">
    
    <!-- Strona główna -->
    <url>
        <loc>https://www.malarz.trzebnica.pl</loc>
        <lastmod>2024-01-15</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    
    <!-- Strony usług -->
    <url>
        <loc>https://www.malarz.trzebnica.pl/o-uslugach</loc>
        <lastmod>2024-01-15</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
    </url>
    
    <url>
        <loc>https://www.malarz.trzebnica.pl/o-uslugach?usluga=malowanie-wnetrz</loc>
        <lastmod>2024-01-15</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    
    <url>
        <loc>https://www.malarz.trzebnica.pl/o-uslugach?usluga=szpachlowanie</loc>
        <lastmod>2024-01-15</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    
    <!-- Galeria -->
    <url>
        <loc>https://www.malarz.trzebnica.pl/galeria</loc>
        <lastmod>2024-01-15</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    
    <!-- Projekty z galerią -->
    <url>
        <loc>https://www.malarz.trzebnica.pl/galeria?kategoria=malowanie-wnetrz</loc>
        <lastmod>2024-01-15</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
        <image:image>
            <image:loc>https://www.malarz.trzebnica.pl/assets/images/galeria/projekt-1.jpg</image:loc>
            <image:title>Malowanie salonu - Trzebnica</image:title>
        </image:image>
    </url>
    
    <!-- Kontakt -->
    <url>
        <loc>https://www.malarz.trzebnica.pl/kontakt</loc>
        <lastmod>2024-01-15</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
</urlset>
```

### 4.3 Dynamiczne Generowanie Sitemap'a

**Plik: src/Controllers/SitemapController.php**

```php
<?php
namespace App\Controllers;

use App\Models\Projekt;

class SitemapController extends BaseController
{
    public function generate()
    {
        header('Content-Type: application/xml; charset=utf-8');
        
        $baseUrl = 'https://www.malarz.trzebnica.pl';
        $projektyModel = new Projekt($this->db);
        $projekty = $projektyModel->getAll();
        
        // Pobierz kategorie
        $this->db->query('SELECT DISTINCT kategoria FROM projekty ORDER BY kategoria');
        $kategorie = $this->db->getAll();
        
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        // Statyczne strony
        $staticPages = [
            ['loc' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => '/galeria', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => '/o-uslugach', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => '/kontakt', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ];
        
        foreach ($staticPages as $page) {
            echo '<url>';
            echo '<loc>' . htmlspecialchars($baseUrl . $page['loc']) . '</loc>';
            echo '<priority>' . $page['priority'] . '</priority>';
            echo '<changefreq>' . $page['changefreq'] . '</changefreq>';
            echo '</url>';
        }
        
        // Kategorie
        foreach ($kategorie as $cat) {
            echo '<url>';
            echo '<loc>' . htmlspecialchars($baseUrl . '/galeria?kategoria=' . urlencode($cat['kategoria'])) . '</loc>';
            echo '<priority>0.7</priority>';
            echo '<changefreq>weekly</changefreq>';
            echo '</url>';
        }
        
        // Projekty
        foreach ($projekty as $projekt) {
            echo '<url>';
            echo '<loc>' . htmlspecialchars($baseUrl . '/galeria/projekt?id=' . $projekt['id']) . '</loc>';
            echo '<lastmod>' . date('Y-m-d', strtotime($projekt['data_utworzenia'])) . '</lastmod>';
            echo '<priority>0.6</priority>';
            echo '<changefreq>monthly</changefreq>';
            echo '</url>';
        }
        
        echo '</urlset>';
        exit;
    }
}
```

### 4.4 Meta Robots Tag

```html
<!-- Na wszystkich stronach (w head) -->
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">

<!-- Dla stron które nie chcemy indeksować -->
<meta name="robots" content="noindex, follow">
```

### 4.5 Optymalizacja Prędkości Strony

```php
<!-- Preload krityczne zasoby -->
<link rel="preload" as="style" href="/assets/css/bootstrap.min.css">
<link rel="preload" as="script" href="/assets/js/app.js">

<!-- Prefetch dla zasobów drugiego planu -->
<link rel="prefetch" href="/assets/images/galeria/projekt-1.jpg">

<!-- DNS prefetch dla CDN -->
<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
```

---

## 5. Local SEO

### 5.1 Google Business Profile (GMB)

**Checklist:**
- ✅ Tworzenie/aktualizacja profilu
- ✅ Pełne informacje (adres, telefon, godziny)
- ✅ Zdjęcia wysokiej jakości (minimum 10)
- ✅ Regularne posty
- ✅ Odpowiadanie na recenzje
- ✅ Dodawanie FAQ
- ✅ Weryfikacja profilu

**Link do zarządzania:** https://business.google.com

### 5.2 Oprawy Lokalne

```html
<!-- W stronie kontaktu -->
<div itemscope itemtype="http://schema.org/LocalBusiness">
    <span itemprop="name">Malarz Trzebnica</span>
    
    <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
        <span itemprop="streetAddress">ul. Słowackiego 10</span>
        <span itemprop="addressLocality">Trzebnica</span>
        <span itemprop="postalCode">55-100</span>
    </div>
    
    <span itemprop="telephone">+48 452 690 824</span>
    
    <a itemprop="url" href="https://www.malarz.trzebnica.pl">
        www.malarz.trzebnica.pl
    </a>
</div>
```

### 5.3 Recenzje i Opinie

```php
<!-- Formularz do zbierania opinii -->
<div class="reviews-section">
    <h2>Opinie Naszych Klientów</h2>
    
    <!-- Linki do recenzji -->
    <a href="https://www.google.com/maps/place/Malarz+Trzebnica" target="_blank">
        Oceń nas na Google Maps
    </a>
    
    <!-- Rich snippet dla recenzji -->
    <div itemscope itemtype="https://schema.org/Review">
        <span itemprop="author">Jan Kowalski</span>
        <span itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
            <span itemprop="ratingValue">5</span>/
            <span itemprop="bestRating">5</span>
        </span>
        <span itemprop="reviewBody">
            Świetna praca! Wszystko wykonane profesjonalnie i na czas.
        </span>
        <span itemprop="datePublished">2024-01-10</span>
    </div>
</div>
```

### 5.4 Citations (Cytowania)

Dodaj biznes do katalogów:
- Google My Business
- Bing Places
- Yandex Maps
- Facebook
- lokalny.pl
- Kontakt.pl
- Szukaj.net
- Katalog.net.pl

---

## 6. Content Marketing

### 6.1 Blog - Artykuły SEO-Friendly

**Tematy artykułów:**
1. "Jak malować ścianę - Poradnik dla Początkujących"
2. "Szpachlowanie ścian - Krok po Kroku"
3. "Jaką Farbę Wybrać do Malowania Wnętrz?"
4. "Renowacja Elewacji Domu - Kiedy i Jak?"
5. "Glazura vs Kafelka - Porównanie"

**Szablon artykułu:**

```markdown
# Jak Malować Ścianę - Poradnik dla Początkujących w Trzebnicy

## Wstęp
Chcesz samodzielnie pomalować ścianę w domu w Trzebnicy? Nasz poradnik...

## 1. Przygotowanie Powierzchni
### 1.1 Czyszczenie
...

## Podsumowanie
Chociaż malowanie wygląda na proste...

## Call-to-Action
Potrzebujesz pomocy? Skontaktuj się z Malarzem Trzebnica - profesjonalną firmą z 15-letnim doświadczeniem.

---
Opublikowano: 15 stycznia 2024
Autor: Zespół Malarz Trzebnica
```

### 6.2 FAQ Schema

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Jak długo trwa malowanie pokoju?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Czas malowania pokoju zależy od rozmiarów i stanu ścian. Zwykle malowanie pokoju o powierzchni 20m² trwa 1-2 dni."
      }
    },
    {
      "@type": "Question",
      "name": "Jaką farbę polecacie?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Polecamy farby klasy premium od renomowanych marek takich jak Tikkurila, Dulux czy Sikkens."
      }
    }
  ]
}
</script>
```

---

## 7. Off-Page SEO

### 7.1 Link Building

**Strategie budowania linków:**

1. **Local Citations** (wymienione wyżej)
2. **Directories i Katalogi**
   - dmoztools.pl
   - katalogy-serwisu.pl
   - biznesownik.pl

3. **Guest Posting**
   - Artykuły na blogach o budownictwie
   - Współprace z portalami poświęconymi remontom

4. **Press Releases**
   - Ogłoszenia o nowych usługach
   - Wiadomości o sukcesach firmy

5. **Social Signals**
   - Facebook Page: https://facebook.com/malarz-trzebnica
   - Instagram: @malarz_trzebnica
   - YouTube: Kanał z poradami

### 7.2 Social Media SEO

```php
<!-- Struktura postów na Facebooku -->

📌 PONIEDZIALEK - TIP PONIEDZIAŁEK
"5 Błędów w Malowaniu, Które Popełniasz! 🎨
Błąd #1: Niedostateczne przygotowanie ścian..."
[Link do artykułu]

📌 SRODA - CASE STUDY
"Malowanie Salonu - Przed i Po 🏠
Klient pragnął oświeżyć swój salon..."
[Zdjęcie przed/po + link do galerii]

📌 PIATEK - PROMOCJA
"Rabat 15% na usługi szpachlowania! 🔨
Mamy dla Ciebie doskonałą ofertę..."
```

---

## 8. Tracking i Analytics

### 8.1 Google Analytics 4

**Plik: src/Views/layouts/main.php**

```html
<!-- Google Analytics 4 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-XXXXXXXXXX', {
    'page_path': window.location.pathname,
    'anonymize_ip': true
  });
</script>
```

### 8.2 Google Search Console

**Checklist:**
- ✅ Zweryfikuj domenę
- ✅ Prześlij sitemap.xml
- ✅ Monitoruj błędy crawlowania
- ✅ Analizuj SourceKeyword Report
- ✅ Monitoruj CTR i impressions

**Link:** https://search.google.com/search-console

### 8.3 Śledzenie Konwersji

```html
<!-- Śledzenie formularza kontaktu -->
<script>
document.getElementById('contact-form').addEventListener('submit', function() {
    gtag('event', 'form_submit', {
        'event_category': 'engagement',
        'event_label': 'contact_form'
    });
});
</script>

<!-- Śledzenie kliknięcia telefonu -->
<script>
document.querySelectorAll('a[href^="tel:"]').forEach(link => {
    link.addEventListener('click', function() {
        gtag('event', 'phone_click', {
            'event_category': 'engagement',
            'event_label': 'phone_number',
            'phone_number': this.href
        });
    });
});
</script>
```

---

## 9. Checklist SEO

### Na Launch'u:
- ✅ Meta title (50-60 znaków)
- ✅ Meta description (150-160 znaków)
- ✅ H1 tag (jeden na stronę)
- ✅ Keyword research
- ✅ Schema.org markup
- ✅ robots.txt
- ✅ sitemap.xml
- ✅ Canonical URLs
- ✅ Mobile responsywność
- ✅ Core Web Vitals

### Po Launch'u:
- ✅ Google Search Console
- ✅ Google Analytics
- ✅ Google My Business
- ✅ Bing Webmaster Tools
- ✅ Backlink profile
- ✅ Local citations
- ✅ Social media

### Regularnie:
- ✅ Monitoruj rankings
- ✅ Aktualizuj artykuły
- ✅ Dodawaj nową zawartość
- ✅ Odpowiadaj na recenzje
- ✅ Analizuj analytics

---

## 10. Metryki Sukcesu

| Metrika | Cel | Gdzie Mierzyć |
|---------|-----|---|
| Organic Traffic | +150% w 6 miesięcy | Google Analytics |
| Ranking Keywords | #1 dla "malarz Trzebnica" | Google Search Console |
| Click-Through Rate (CTR) | >3% | Google Search Console |
| Average Position | <5 dla głównych słów kluczy | Google Search Console |
| Local Pack Visibility | Top 3 | Google Maps |
| Reviews Rating | 4.5+ | Google My Business |
| Backlinks | 20+ quality links | Ahrefs, SEMrush |
| Core Web Vitals | All Green | PageSpeed Insights |

---

## 11. Harmonogram SEO (6 Miesięcy)

### Miesiąc 1-2: Fundamenty
- Setup GSC i Analytics
- On-page optimization
- Local citations
- Technical fixes

### Miesiąc 2-3: Content
- 4x artykuły bloga
- Case studies (galeria)
- FAQ page
- Local content

### Miesiąc 3-4: Link Building
- Guest posts
- Press releases
- Directory submissions
- Sponsor local events

### Miesiąc 4-6: Growth
- Expand content
- Social media
- Reviews management
- Continuous optimization

---

## Podsumowanie

Strategia SEO dla **Malarz Trzebnica** fokusuje się na:

1. ✅ **Local SEO** - Ranking w lokalnych wynikach
2. ✅ **On-Page SEO** - Optymalizacja zawartości
3. ✅ **Technical SEO** - Szybkość i struktura
4. ✅ **Content Marketing** - Wartościowe artykuły
5. ✅ **Link Building** - Budowanie autorytetu
6. ✅ **Analytics** - Monitorowanie i optymalizacja

Kompleksowe podejście do SEO zajmie 6-12 miesięcy, ale wyniki będą długotrwałe i samonapędzające się.

**Estymowany ROI:** 3-5x zwrot z inwestycji w SEO w ciągu roku.

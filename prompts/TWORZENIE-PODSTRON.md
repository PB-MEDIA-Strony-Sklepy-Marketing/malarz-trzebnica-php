# Prompt: Tworzenie Podstron - Malarz Trzebnica

## Zadanie

Wygeneruj wszystkie podstrony serwisu Malarz Trzebnica w architekturze PHP MVC.

## Wymagane Podstrony

### 1. Strona Główna (/)

**Sekcje:**
- Hero section z CTA "Bezpłatna Wycena"
- O firmie - krótki opis, doświadczenie
- Usługi - kafelki 6 głównych usług z ikonami
- Portfolio - 6 najnowszych realizacji z galerii
- Opinie klientów - slider z testimonialsami
- Kontakt - sekcja z formularzem i danymi

**SEO:**
- Title: "Malarz Trzebnica - Profesjonalne Usługi Malarskie | Precision, Perfection, Professional"
- Meta description: "Malarz Trzebnica oferuje kompleksowe usługi malarskie: malowanie wnętrz i elewacji, szpachlowanie, sucha zabudowa GK. ☎ +48 452 690 824"
- H1: "Profesjonalne Usługi Malarskie w Trzebnicy"

### 2. Oferta (/oferta)

**Treść:**
- Szczegółowy opis każdej usługi
- Cennik orientacyjny
- Proces realizacji (krok po kroku)
- FAQ dotyczące usług
- CTA do kontaktu

**SEO:**
- Title: "Oferta - Usługi Malarskie Trzebnica | Cennik i Zakres"
- H1: "Oferta Usług Malarskich"
- H2 dla każdej usługi

### 3. Galeria (/galeria)

**Funkcjonalność:**
- Grid zdjęć (3 kolumny desktop, 2 tablet, 1 mobile)
- Lightbox GLightbox
- Kategorii filtrowania: Wszystkie, Wnętrza, Elewacje, GK, Podłogi
- Lazy loading obrazów

**SEO:**
- Title: "Galeria Realizacji - Portfolio Malarz Trzebnica"
- H1: "Nasze Realizacje"
- Alt texts dla każdego zdjęcia

### 4. Kontakt (/kontakt)

**Elementy:**
- Formularz kontaktowy (imię, email, telefon, wiadomość)
- Mapa Google Maps (Trzebnica)
- Dane kontaktowe (tel, email, godziny)
- Social media links

**Zabezpieczenia:**
- CSRF token
- Honeypot field
- Rate limiting
- Server-side validation

**SEO:**
- Title: "Kontakt - Malarz Trzebnica | Bezpłatna Wycena"
- H1: "Skontaktuj się z nami"

## Wymagania Techniczne

### Kontrolery

```php
<?php
namespace App\Controllers;

class HomeController extends Controller
{
    public function index(): void
    {
        $data = [
            'title' => 'Malarz Trzebnica - Profesjonalne Usługi Malarskie',
            'description' => '...',
            'services' => $this->getServices(),
            'portfolio' => $this->getLatestPortfolio(6),
        ];
        
        $this->render('pages/home', $data);
    }
}
```

### Widoki

```php
<!-- views/pages/home.php -->
<?php $this->layout('layouts/default', ['title' => $title]) ?>

<section class="hero">
    <!-- Hero content -->
</section>

<section class="services">
    <!-- Services grid -->
</section>
```

### Routing

```php
['GET', '/', 'HomeController@index'],
['GET', '/oferta', 'OfferController@index'],
['GET', '/galeria', 'GalleryController@index'],
['GET', '/kontakt', 'ContactController@index'],
['POST', '/kontakt/wyslij', 'ContactController@send'],
```

## Akcje

1. Utwórz kontrolery w `dist/app/Controllers/`
2. Utwórz widoki w `dist/app/Views/pages/`
3. Zaktualizuj routing w `dist/config/routes.php`
4. Dodaj meta tagi SEO
5. Przetestuj responsywność
6. Waliduj accessibility (WCAG 2.1)

---
**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm

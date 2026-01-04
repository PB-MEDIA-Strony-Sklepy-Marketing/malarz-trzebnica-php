# GitHub Copilot - Najlepsze Praktyki dla Projektu Malarz Trzebnica

> Przewodnik po efektywnym wykorzystaniu GitHub Copilot w projekcie PHP MVC

---

## Wprowadzenie

GitHub Copilot to asystent AI do programowania zintegrowany z VS Code i innymi IDE. Dla projektu Malarz Trzebnica skonfigurujemy go do efektywnej pracy z architektura PHP MVC.

---

## Konfiguracja VS Code

### Wymagane Rozszerzenia
```json
{
  "recommendations": [
    "github.copilot",
    "github.copilot-chat",
    "bmewburn.vscode-intelephense-client"
  ]
}
```

### Ustawienia Copilot
```json
{
  "github.copilot.enable": {
    "*": true,
    "php": true,
    "html": true,
    "css": true,
    "javascript": true
  },
  "editor.inlineSuggest.enabled": true
}
```

---

## Instrukcje Copilot

Utworz plik .github/copilot-instructions.md:

```
# Copilot Instructions - Malarz Trzebnica

## Project Context
PHP MVC website for professional painting company.

### Company Information
- Name: Malarz Trzebnica
- Website: www.malarz.trzebnica.pl
- Phone: +48 452 690 824
- Location: Trzebnica, Poland

### Tech Stack
- PHP 7.4+ with PSR-4 autoloading
- Bootstrap 5
- jQuery, GSAP, Swiper.js
- Apache with mod_rewrite

### Coding Standards
- PSR-12 coding standard
- Always escape output with htmlspecialchars()
- Use CSRF tokens for forms
- Namespace: App\Controllers, App\Models, App\Services
```

---

## Prompty Kontekstowe

### 1. Generowanie Kontrolera
```php
/**
 * ContactController handles contact form submissions
 * - Validates form data (name, email, phone, message)
 * - Implements CSRF protection
 * - Returns JSON response for AJAX
 */
class ContactController
{
    // Copilot zasugeruje metody...
}
```

### 2. Tworzenie Modelu
```php
/**
 * Service model for painting services
 * Properties: name, description, icon, price_from
 */
class Service
{
    // Copilot wygeneruje...
}
```

### 3. Funkcja Walidacji
```php
/**
 * Validate Polish phone number (+48 XXX XXX XXX or 9 digits)
 */
function validatePolishPhone(string $phone): bool
```

### 4. Komponenty Bootstrap
```php
/**
 * Generate Bootstrap 5 service card
 * Parameters: name, description, icon (Font Awesome)
 */
function renderServiceCard(string $name, string $desc, string $icon): string
```

---

## Techniki Efektywnego Uzycia

### 1. Szczegolowe Komentarze
```php
// Create CSRF token, store in session, return hidden input
function csrfField(): string

// Escape and format price with Polish locale (1 234,56 zl)
function formatPrice(float $amount): string
```

### 2. Dobre Nazewnictwo
```php
public function getServicesForHomepage(): array
public function validateContactFormData(array $data): array
public function sendContactEmailNotification(Contact $contact): bool
```

### 3. Type Hints
```php
public function createService(
    string $name,
    string $description,
    float $priceFrom
): Service
```

---

## Copilot Chat - Przyklady

### Architektura
```
/explain How is MVC implemented in this project?
@workspace How do controllers communicate with views?
```

### Refaktoryzacja
```
/refactor Extract validation logic to separate class
/fix Add CSRF protection to this form handler
```

### Generowanie
```
/generate Create GalleryController with CRUD operations
/generate Write unit tests for ContactService
```

---

## Wzorce dla Projektu

### Kontroler MVC
```php
// dist/app/Controllers/OfertaController.php
// Controller for services page - Malarz Trzebnica

namespace App\Controllers;

class OfertaController
{
    // Copilot rozpozna wzorzec...
}
```

### Helper SEO
```php
// SEO helper for Malarz Trzebnica website

namespace App\Helpers;

class SeoHelper
{
    private const COMPANY_NAME = 'Malarz Trzebnica';
    private const PHONE = '+48 452 690 824';
    // Copilot wie jaki kontekst
}
```

---

## Skroty Klawiszowe

| Akcja | Windows | macOS |
|-------|---------|-------|
| Akceptuj sugestie | Tab | Tab |
| Odrzuc | Esc | Esc |
| Nastepna sugestia | Alt+] | Option+] |
| Copilot Chat | Ctrl+I | Cmd+I |

---

**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm

*GitHub Copilot instrukcje - Styczen 2025*

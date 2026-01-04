# Cursor IDE - Instrukcje dla Projektu Malarz Trzebnica

> Konfiguracja i najlepsze praktyki Cursor IDE do pracy z projektem PHP MVC

---

## Wprowadzenie

Cursor to IDE oparte na VS Code z wbudowana integracja AI. Oferuje:
- Natywne wsparcie dla Claude i GPT-4
- Kontekst calego projektu (@codebase)
- Inline editing z AI
- Automatyczne uzupelnianie kodu

---

## Instalacja i Konfiguracja

### 1. Pobieranie Cursor
```
https://cursor.com/download
```

### 2. Import Ustawien VS Code
Cursor automatycznie importuje ustawienia i rozszerzenia z VS Code.

### 3. Konfiguracja AI
```
Settings > AI > Model: claude-3.5-sonnet (rekomendowany)
Settings > AI > Enable Codebase Indexing: On
```

---

## Rules for AI - Plik Konfiguracyjny

Utworz plik .cursorrules w katalogu glownym projektu:

```
# .cursorrules - Malarz Trzebnica PHP Project

## Project Overview
This is a PHP MVC website for a professional painting company "Malarz Trzebnica".
Website: www.malarz.trzebnica.pl
Phone: +48 452 690 824
Location: Trzebnica, Poland

## Tech Stack
- PHP 7.4+ with Composer and PSR-4 autoloading
- Bootstrap 5 for responsive design
- jQuery for DOM manipulation
- GSAP and Swiper.js for animations
- Apache with mod_rewrite for friendly URLs

## Project Structure
- dist/ - Production files (main development directory)
  - index.php, oferta.php, galeria.php, kontakt.php
  - includes/ - header.php, footer.php, config.php
  - app/Controllers/ - MVC Controllers
  - app/Models/ - Data models
  - app/Services/ - Business logic services
  - app/Helpers/ - Helper functions
  - assets/ - CSS, JS, images
- src/ - Original HTML templates
- docs/ - Documentation
- agents/ - AI agent configurations

## Coding Standards
1. Follow PSR-12 coding standard for PHP
2. Use PascalCase for classes, camelCase for methods/variables
3. Always escape output: htmlspecialchars($var, ENT_QUOTES, UTF-8)
4. Validate all input data on server side
5. Implement CSRF tokens for all forms
6. Use type hints in PHP 7.4+ syntax
7. Write code in English, content/comments can be in Polish
8. Use meaningful variable and function names

## Security Requirements
- Sanitize all user inputs
- Use prepared statements for database queries
- Implement honeypot fields for spam protection
- Never expose sensitive data in error messages
- Use HTTPS redirects in production

## SEO Requirements
- Include meta title, description, keywords on each page
- Use Open Graph tags for social sharing
- Implement Schema.org LocalBusiness markup
- Target keywords: malarz Trzebnica, uslugi malarskie

## Services (Company Offerings)
- Interior painting (malowanie wnetrz)
- Exterior painting (malowanie elewacji)
- Wall plastering (szpachlowanie scian)
- Drywall installation (sucha zabudowa GK)
- Floor installation (ukladanie podlog)
- Tiling (glazura)

## Response Format
- Generate clean, production-ready code
- Include PHPDoc comments for classes and methods
- Provide brief explanations when making architectural decisions
- Suggest security improvements when relevant
```

---

## Polecenia Cursor

### @codebase - Kontekst Projektu
```
@codebase How is the MVC pattern implemented?
@codebase Where is form validation handled?
@codebase Find all usages of htmlspecialchars
```

### @file - Kontekst Pliku
```
@file:dist/kontakt.php Add CSRF protection
@file:dist/includes/header.php Add Open Graph meta tags
@file:composer.json Add PHPMailer dependency
```

### @docs - Dokumentacja
```
@docs Create installation guide for this project
@docs Generate API documentation for controllers
```

### @web - Wyszukiwanie
```
@web Best practices for PHP contact form security
@web Schema.org LocalBusiness markup example
```

---

## Skroty Klawiszowe

| Akcja | Windows/Linux | macOS |
|-------|---------------|-------|
| Cmd+K (Inline Edit) | Ctrl+K | Cmd+K |
| Cmd+L (Chat) | Ctrl+L | Cmd+L |
| Cmd+I (Composer) | Ctrl+I | Cmd+I |
| Accept Suggestion | Tab | Tab |
| Reject Suggestion | Esc | Esc |
| Next Suggestion | Alt+] | Option+] |
| Toggle AI Panel | Ctrl+Shift+L | Cmd+Shift+L |

---

## Przyklady Uzycia

### 1. Generowanie Kontrolera
```
Cmd+K w pustym pliku:
"Create ContactController for Malarz Trzebnica with:
- submit() method for form handling
- CSRF validation
- Email sending via PHPMailer
- JSON response for AJAX"
```

### 2. Refaktoryzacja
```
Zaznacz kod, Cmd+K:
"Refactor this to use dependency injection and add validation"
```

### 3. Dodawanie Funkcji
```
Cmd+K w pliku:
"Add function to generate SEO meta tags for page: $pageName
Include title, description, og:* tags
Use Malarz Trzebnica company data"
```

### 4. Debugging
```
Cmd+L (Chat):
"@file:dist/kontakt.php Why might this form return 500 error?
Check validation, CSRF, and mail sending."
```

### 5. Dokumentacja
```
Cmd+L:
"@codebase Generate PHPDoc for all public methods in Controllers/"
```

---

## Konfiguracja Projektu

### .cursor/settings.json
```json
{
  "cursor.cpp.disabledLanguages": [],
  "cursor.general.enableAI": true,
  "cursor.ai.model": "claude-3.5-sonnet",
  "cursor.ai.temperature": 0.3,
  "cursor.codebase.enabled": true,
  "cursor.codebase.autoIndex": true,
  "files.associations": {
    "*.php": "php"
  },
  "php.validate.executablePath": "php",
  "editor.formatOnSave": true
}
```

### Ignorowanie Plikow dla Indeksowania
```
# .cursorignore
node_modules/
vendor/
.git/
*.log
*.sql
.env
dist/uploads/
cache/
```

---

## Workflow dla Projektu

### 1. Nowa Funkcjonalnosc
```
1. Cmd+L: "@codebase Describe current architecture for [feature]"
2. Cmd+K: "Create [Component] following existing patterns"
3. Cmd+K: "Add tests for [Component]"
4. Cmd+L: "Review code for security issues"
```

### 2. Debugging
```
1. Cmd+L: "@file:[plik] Explain what this code does"
2. Cmd+K: "Add debug logging to this function"
3. Cmd+L: "What could cause [error] in this context?"
4. Cmd+K: "Fix the issue and add error handling"
```

### 3. Optymalizacja
```
1. Cmd+L: "@codebase Find performance bottlenecks"
2. Cmd+K: "Optimize this database query"
3. Cmd+K: "Add caching to this function"
4. Cmd+L: "Review optimization for side effects"
```

---

## Szablony Promptow

### Kontroler MVC
```
Create a [Name]Controller class in namespace App\Controllers.
Methods: index(), show($id), create(), store(), update($id), delete($id).
Include CSRF protection, validation, and JSON responses.
Follow PSR-12 and project conventions.
```

### Model
```
Create a [Name] model in namespace App\Models.
Properties: [list properties with types].
Methods: validate(), toArray(), save(), find($id).
Use type hints and PHPDoc comments.
```

### Serwis
```
Create a [Name]Service in namespace App\Services.
Purpose: [describe business logic].
Use dependency injection for dependencies.
Include error handling and logging.
```

### Widok PHP
```
Create a view template for [page name].
Include: header, main content sections, footer.
Use Bootstrap 5 classes for layout.
Escape all dynamic data with htmlspecialchars().
```

---

## Rozwiazywanie Problemow

### AI nie rozumie kontekstu projektu
1. Upewnij sie ze .cursorrules istnieje
2. Wlacz Codebase Indexing w ustawieniach
3. Uzyj @codebase lub @file dla kontekstu

### Wolne odpowiedzi
1. Zmniejsz zakres kontekstu (@file zamiast @codebase)
2. Uzyj bardziej precyzyjnych promptow
3. Rozważ uzycie szybszego modelu

### Sugestie sa nieadekwatne
1. Popraw .cursorrules z wiekszym kontekstem
2. Dodaj przyklady kodu w rules
3. Uzyj explicit instructions w prompcie

---

## Integracja z Git

### Commit Message
```
Cmd+L: "Generate commit message for staged changes"
```

### Code Review
```
Cmd+L: "@git:diff Review these changes for:
- Security issues
- Performance problems
- Code style violations
- Missing tests"
```

---

**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm

*Cursor IDE instrukcje - Styczen 2025*

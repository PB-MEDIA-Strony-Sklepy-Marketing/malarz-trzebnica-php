# Lista Plików Konfiguracyjnych do Wygenerowania

## Kolejność Generowania Plików dla Repozytorium malarz-trzebnica-php

### FAZA 1: Pliki Fundamentalne Repozytorium (Priorytet Najwyższy)

1. **`.gitignore`**
   
   - Wykluczenie plików tymczasowych, vendor/, node_modules/, cache/, uploads/test/

2. **`README.md`** (główny)
   
   - Opis projektu firmy Malarz Trzebnica
   - Struktura katalogów
   - Quick start guide
   - Linki do szczegółowej dokumentacji

3. **`LICENSE`**
   
   - Licencja projektu (MIT lub proprietary)

4. **`.editorconfig`**
   
   - Standardy formatowania kodu (PHP, HTML, CSS, JS)

5. **`composer.json`**
   
   - Konfiguracja autoloadingu PSR-4 dla architektury MVC
   - Zależności PHP (np. PHPMailer dla formularza)

6. **`.htaccess`** (dla dist/)
   
   - Friendly URLs dla MVC routing
   - Przekierowania HTTP→HTTPS
   - Kompresja GZIP
   - Cache headers

---

### FAZA 2: Konfiguracja GitHub Actions & Workflows

7. **`.github/workflows/php-lint.yml`**
   
   - Automatyczna walidacja składni PHP
   - PHP CodeSniffer (PSR-12)

8. **`.github/workflows/deploy-production.yml`**
   
   - Automatyczne wdrożenie na serwer produkcyjny via FTP/SSH

9. **`.github/workflows/lighthouse-ci.yml`**
   
   - Testy wydajności, SEO i dostępności

10. **`.github/workflows/backup.yml`**
    
    - Automatyczne backupy repozytorium co tydzień

11. **`.github/ISSUE_TEMPLATE/bug_report.md`**
    
    - Szablon zgłaszania błędów

12. **`.github/ISSUE_TEMPLATE/feature_request.md`**
    
    - Szablon propozycji nowych funkcjonalności

13. **`.github/PULL_REQUEST_TEMPLATE.md`**
    
    - Szablon pull requestów

14. **`.github/CODEOWNERS`**
    
    - Definicja właścicieli poszczególnych części kodu

---

### FAZA 3: Dokumentacja AI Agents (dla Claude AI Projects)

15. **`agents/AGENTS.md`**
    
    - Główny przewodnik po agentach AI w projekcie
    - Lista wszystkich agentów i ich specjalizacje

16. **`agents/CLAUDE.md`**
    
    - Szczegółowe instrukcje dla Claude AI
    - Kontekst projektu Malarz Trzebnica
    - Przykłady promptów specyficznych dla projektu
    - Zasady pracy z architekturą MVC

17. **`agents/OLLAMA.md`**
    
    - Instrukcje dla lokalnych modeli Ollama
    - Konfiguracja modeli (llama2, codellama)
    - Przykłady użycia offline

18. **`agents/QWEN.md`**
    
    - Instrukcje dla modeli Qwen (Alibaba Cloud)
    - Specyfika pracy z chińskimi modelami
    - Przykłady promptów w języku polskim i angielskim

19. **`agents/GITHUB-COPILOT.md`**
    
    - Najlepsze praktyki pracy z GitHub Copilot
    - Prompty kontekstowe dla projektu PHP MVC

20. **`agents/CURSOR.md`**
    
    - Instrukcje dla Cursor IDE
    - Konfiguracja rules dla projektu

---

### FAZA 4: Dokumentacja Projektu (docs/)

21. **`docs/INSTALACJA.md`**
    
    - Wymagania serwerowe (PHP 7.4+, Apache/Nginx)
    - Instrukcja instalacji krok po kroku
    - Konfiguracja bazy danych (jeśli potrzebna)
    - Ustawienia uprawnień katalogów

22. **`docs/STRUKTURA.md`**
    
    - Szczegółowy opis architektury MVC
    - Opis każdego katalogu i pliku
    - Diagram struktury projektu (ASCII art lub link do Mermaid)

23. **`docs/EDYCJA_TRESCI.md`**
    
    - Jak edytować treści na stronach
    - Jak dodać zdjęcia do galerii
    - Jak zarządzać portfolio realizacji

24. **`docs/WYMAGANIA.md`**
    
    - Wymagania techniczne serwera
    - Lista rozszerzeń PHP
    - Wymagania dotyczące baz danych
    - Konfiguracja mod_rewrite

25. **`docs/ARCHITEKTURA-MVC.md`**
    
    - Szczegółowy opis wzorca MVC w projekcie
    - Routing system
    - Autoloading klas PSR-4
    - Przepływ danych Model→View→Controller

26. **`docs/GALERIA-LIGHTBOX.md`**
    
    - Dokumentacja implementacji galerii
    - Wybrana biblioteka lightbox (GLightbox/Lightbox2)
    - Jak dodawać nowe zdjęcia
    - Optymalizacja obrazów

27. **`docs/SEO.md`**
    
    - Strategia SEO dla firmy lokalnej
    - Meta tagi dla każdej podstrony
    - Schema.org markup dla LocalBusiness
    - Słowa kluczowe: "malarz Trzebnica", "usługi malarskie"

28. **`docs/BEZPIECZENSTWO.md`**
    
    - Zabezpieczenia formularza kontaktowego
    - Ochrona przed XSS, CSRF, SQL Injection
    - Walidacja danych po stronie serwera
    - Limity rate limiting

29. **`docs/DEPLOYMENT.md`**
    
    - Instrukcja wdrożenia na www.malarz.trzebnica.pl
    - Konfiguracja DNS
    - Certyfikat SSL
    - Monitoring i logi

30. **`docs/CHANGELOG.md`**
    
    - Historia zmian w projekcie
    - Wersjonowanie semantyczne

31. **`docs/API-DOCUMENTATION.md`**
    
    - Dokumentacja API formularza kontaktowego
    - Endpointy PHP
    - Przykłady requestów i responses

---

### FAZA 5: Instrukcje Deweloperskie (instructions/)

32. **`instructions/CODING-STANDARDS.md`**
    
    - PSR-4, PSR-12 standards
    - Konwencje nazewnictwa (camelCase, PascalCase)
    - Komentarze w języku polskim

33. **`instructions/GIT-WORKFLOW.md`**
    
    - Branch strategy (main, develop, feature/*)
    - Commit message conventions
    - Pull request process

34. **`instructions/TESTING.md`**
    
    - Strategia testowania (unit tests, integration tests)
    - Narzędzia (PHPUnit)
    - Pokrycie kodu testami

35. **`instructions/CODE-REVIEW.md`**
    
    - Checklist dla code review
    - Co sprawdzać w PR
    - Kryteria akceptacji

36. **`instructions/RESPONSIVE-DESIGN.md`**
    
    - Breakpointy Bootstrap
    - Mobile-first approach
    - Testy na urządzeniach mobilnych

37. **`instructions/PERFORMANCE.md`**
    
    - Optymalizacja wydajności PHP
    - Lazy loading obrazów
    - Minifikacja CSS/JS
    - Cache strategy

---

### FAZA 6: Prompty dla AI (prompts/)

38. **`prompts/PROJEKT-KONTEKST.md`**
    
    - Pełny kontekst projektu dla AI
    - Firma Malarz Trzebnica, slogan, usługi
    - Dane kontaktowe

39. **`prompts/KONWERSJA-HTML-PHP.md`**
    
    - Prompt do konwersji HTML na PHP MVC
    - Przykłady i oczekiwania

40. **`prompts/TWORZENIE-PODSTRON.md`**
    
    - Prompty dla generowania każdej podstrony
    - Strona główna, Oferta, Galeria, Kontakt

41. **`prompts/GALERIA-LIGHTBOX.md`**
    
    - Prompt do implementacji galerii z lightbox
    - Integracja z Bootstrap

42. **`prompts/FORMULARZ-KONTAKTOWY.md`**
    
    - Prompt do stworzenia formularza z walidacją PHP
    - Zabezpieczenia CSRF, XSS

43. **`prompts/SEO-OPTIMIZATION.md`**
    
    - Prompt do optymalizacji SEO
    - Meta tagi, Schema.org, Open Graph

44. **`prompts/RESPONSYWNOSC.md`**
    
    - Prompt do testowania i poprawy responsywności

45. **`prompts/DEBUGGING.md`**
    
    - Prompt do debugowania błędów PHP/JavaScript

---

### FAZA 7: Baza Wiedzy (knowledge/)

46. **`knowledge/FIRMA-MALARZ-TRZEBNICA.md`**
    
    - Pełne informacje o firmie
    - Historia, zespół, wartości
    - Portfolio realizacji

47. **`knowledge/USLUGI.md`**
    
    - Szczegółowy opis wszystkich usług:
    - Malowanie wnętrz i elewacji
    - Szpachlowanie
    - Sucha zabudowa GK
    - Podłogi, glazura, wykończenia

48. **`knowledge/SPRZET.md`**
    
    - Lista profesjonalnego sprzętu
    - Technologie stosowane przez firmę

49. **`knowledge/KONKURENCJA.md`**
    
    - Analiza konkurencji lokalnej
    - Unique Selling Points (USP)

50. **`knowledge/BRANDING.md`**
    
    - Logo, kolory, czcionki
    - Slogan: "Precision, Perfection, Professional"
    - Tone of voice

51. **`knowledge/SŁOWA-KLUCZOWE.md`**
    
    - SEO keywords research
    - Frazy lokalne i ogólne

---

### FAZA 8: Konfiguracja Projektu PHP

52. **`dist/config/config.php`**
    
    - Główna konfiguracja aplikacji MVC
    - Database credentials (jeśli używana)
    - Ustawienia email dla formularza

53. **`dist/config/database.php`**
    
    - Konfiguracja połączenia z bazą danych
    - PDO settings

54. **`dist/config/routes.php`**
    
    - Definicja tras aplikacji MVC
    - Routing rules

55. **`dist/.htaccess`**
    
    - Friendly URLs
    - Security headers
    - Kompresja i cache

56. **`dist/autoload.php`**
    
    - PSR-4 autoloader dla klas MVC

57. **`dist/bootstrap.php`**
    
    - Inicjalizacja aplikacji
    - Ładowanie konfiguracji
    - Routing setup

---

### FAZA 9: Struktury MVC Core

58. **`dist/core/Router.php`**
    
    - Klasa obsługująca routing

59. **`dist/core/Controller.php`**
    
    - Bazowy kontroler dla wszystkich kontrolerów

60. **`dist/core/View.php`**
    
    - Klasa do renderowania widoków

61. **`dist/core/Model.php`**
    
    - Bazowy model (jeśli używana baza danych)

62. **`dist/core/Request.php`**
    
    - Obsługa HTTP requests

63. **`dist/core/Response.php`**
    
    - Obsługa HTTP responses

64. **`dist/core/Validator.php`**
    
    - Walidacja danych formularzy

65. **`dist/core/Security.php`**
    
    - Funkcje bezpieczeństwa (CSRF tokens, XSS protection)

---

### FAZA 10: Pliki Package Management

66. **`package.json`**
    
    - NPM dependencies (Bootstrap, lightbox library)
    - Build scripts dla front-end

67. **`webpack.config.js`** lub **`vite.config.js`**
    
    - Bundling assets
    - Minifikacja CSS/JS

68. **`.npmrc`**
    
    - Konfiguracja npm

---

### FAZA 11: Pliki CI/CD & DevOps

69. **`docker-compose.yml`**
    
    - Lokalne środowisko deweloperskie (PHP, Apache, MySQL)

70. **`Dockerfile`**
    
    - Kontener dla aplikacji PHP

71. **`.dockerignore`**
    
    - Pliki wykluczane z obrazu Docker

72. **`deploy.sh`**
    
    - Skrypt do wdrożenia na produkcję

73. **`.env.example`**
    
    - Przykładowa konfiguracja zmiennych środowiskowych

---

### FAZA 12: Narzędzia Jakości Kodu

74. **`phpunit.xml`**
    
    - Konfiguracja testów jednostkowych PHP

75. **`phpcs.xml`**
    
    - Konfiguracja PHP CodeSniffer (PSR-12)

76. **`.php-cs-fixer.php`**
    
    - Automatyczne formatowanie kodu PHP

77. **`psalm.xml`** lub **`phpstan.neon`**
    
    - Statyczna analiza kodu PHP

78. **`.eslintrc.json`**
    
    - Linting JavaScript

79. **`.prettierrc`**
    
    - Formatowanie kodu JavaScript/CSS

80. **`.stylelintrc.json`**
    
    - Linting CSS

---

### FAZA 13: Security & Compliance

81. **`SECURITY.md`**
    
    - Polityka bezpieczeństwa
    - Jak zgłaszać podatności

82. **`CODE_OF_CONDUCT.md`**
    
    - Kodeks postępowania dla kontrybutorów

83. **`CONTRIBUTING.md`**
    
    - Jak współtworzyć projekt
    - Guidelines dla pull requestów

---

### FAZA 14: Monitoring & Analytics

84. **`docs/MONITORING.md`**
    
    - Konfiguracja Google Analytics
    - Google Search Console
    - Error tracking (Sentry)

85. **`docs/PERFORMANCE-METRICS.md`**
    
    - Core Web Vitals targets
    - Lighthouse scores goals

---

### FAZA 15: Backup & Recovery

86. **`scripts/backup.sh`**
    
    - Skrypt do backupu bazy danych i plików

87. **`scripts/restore.sh`**
    
    - Skrypt do przywracania backupu

88. **`docs/DISASTER-RECOVERY.md`**
    
    - Plan awaryjny dla strony produkcyjnej

---

### FAZA 16: Content Management

89. **`text/README.md`**
    
    - Instrukcja zarządzania treściami tekstowymi
    - Format plików, struktura

90. **`docs/CONTENT-STRATEGY.md`**
    
    - Strategia treści dla SEO
    - Kalendarz publikacji (blog w przyszłości)

---

### FAZA 17: Accessibility & UX

91. **`docs/ACCESSIBILITY.md`**
    
    - Standardy WCAG 2.1
    - Testy dostępności
    - Alt texts dla galerii

92. **`docs/UX-GUIDELINES.md`**
    
    - Zasady projektowania UX
    - User journey mapping
    - CTA placement strategy

---

### FAZA 18: Legal & Privacy

93. **`docs/PRIVACY-POLICY.md`**
    
    - Polityka prywatności (RODO/GDPR)
    - Przetwarzanie danych z formularza

94. **`docs/TERMS-OF-USE.md`**
    
    - Regulamin korzystania ze strony

95. **`docs/COOKIE-POLICY.md`**
    
    - Polityka cookies
    - Implementacja cookie consent banner

---

### FAZA 19: Marketing & Analytics

96. **`docs/MARKETING-STRATEGY.md`**
    
    - Strategia marketingowa online
    - SEO local, Google My Business

97. **`docs/CONVERSION-OPTIMIZATION.md`**
    
    - Optymalizacja konwersji formularza kontaktowego
    - A/B testing plan

---

### FAZA 20: Maintenance

98. **`docs/MAINTENANCE.md`**
    
    - Plan konserwacji i aktualizacji
    - Harmonogram backupów
    - Update procedures

99. **`ROADMAP.md`**
    
    - Plan rozwoju projektu
    - Przyszłe funkcjonalności (blog, system CMS)

100. **`SUPPORT.md`**
     
     - Jak uzyskać pomoc techniczną
     - FAQ dla klienta

---

## Podsumowanie Priorytetów

### 🔴 **KRYTYCZNE (Generować w pierwszej kolejności)**

- Pliki 1-20: Fundamenty repozytorium, GitHub Actions, AI Agents

### 🟠 **WYSOKIE (Generować w drugiej kolejności)**

- Pliki 21-51: Dokumentacja, prompty, baza wiedzy

### 🟡 **ŚREDNIE (Generować w trzeciej kolejności)**

- Pliki 52-80: Konfiguracja PHP MVC, narzędzia deweloperskie

### 🟢 **NISKIE (Opcjonalne, generować na końcu)**

- Pliki 81-100: Compliance, monitoring, marketing, maintenance

---

## Zalecenia Finalne

1. **Rozpocznij od FAZY 1-3** - fundamenty + GitHub Actions + AI Agents
2. **Następnie FAZA 4-6** - dokumentacja + instrukcje + prompty
3. **Potem FAZA 7-9** - baza wiedzy + konfiguracja PHP + core MVC
4. **Na końcu pozostałe fazy** według potrzeb projektu

Każdy plik powinien być generowany z uwzględnieniem:

- **Kontekstu firmy Malarz Trzebnica**
- **Specyfiki architektury MVC**
- **Wymagań Bootstrap + PHP + lightbox gallery**
- **Standardów GitHub i dokumentacji oficjalnej**
- **Języka polskiego dla dokumentacji i komentarzy**

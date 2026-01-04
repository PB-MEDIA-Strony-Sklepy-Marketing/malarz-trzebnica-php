# Pull Request - Malarz Trzebnica

## 📋 Opis zmian

Jasny i zwięzły opis wprowadzonych zmian.

## 🔗 Powiązane Issue

Closes #(numer issue)
Fixes #(numer issue)
Related to #(numer issue)

## 🎯 Typ zmian

Zaznacz pasujące:

- [ ] 🐛 Bug fix (naprawa błędu)
- [ ] ✨ New feature (nowa funkcjonalność)
- [ ] 💄 UI/UX improvement (poprawa interfejsu)
- [ ] ♻️ Refactoring (refaktoryzacja kodu bez zmian funkcjonalności)
- [ ] ⚡ Performance improvement (optymalizacja wydajności)
- [ ] 📝 Documentation (aktualizacja dokumentacji)
- [ ] 🔒 Security fix (poprawka bezpieczeństwa)
- [ ] ♿ Accessibility (poprawa dostępności)
- [ ] 🔍 SEO improvement (optymalizacja SEO)
- [ ] 🧪 Tests (dodanie/aktualizacja testów)
- [ ] 🔧 Configuration (zmiana konfiguracji)
- [ ] 📦 Dependencies (aktualizacja zależności)

## 📄 Zmienione strony/pliki

Zaznacz wszystkie dotknięte obszary:

- [ ] Strona główna (index.php)
- [ ] Oferta (oferta.php)
- [ ] Galeria (galeria.php)
- [ ] Kontakt (kontakt.php)
- [ ] PHP Backend
- [ ] CSS/Stylowanie
- [ ] JavaScript
- [ ] Dokumentacja
- [ ] GitHub Workflows
- [ ] Konfiguracja
- [ ] Inne: _______________

## 🚀 Wprowadzone zmiany

Lista szczegółowych zmian:

- Zmiana 1
- Zmiana 2
- Zmiana 3

## 🧪 Jak przetestowano?

Opisz testy, które przeprowadzono, aby zweryfikować zmiany:

- [ ] Testy manualne na desktop (Chrome, Firefox, Safari, Edge)
- [ ] Testy manualne na mobile (iOS Safari, Chrome Android)
- [ ] Testy manualne na tablet
- [ ] Testy jednostkowe (PHPUnit)
- [ ] Testy integracyjne
- [ ] Walidacja HTML/CSS
- [ ] PHP Lint + CodeSniffer (PSR-12)
- [ ] PHPStan static analysis
- [ ] Lighthouse CI (Performance, SEO, Accessibility)
- [ ] Testy accessibility (WCAG 2.1)
- [ ] Cross-browser testing

## 📸 Zrzuty ekranu / Nagrania

Jeśli dotyczy UI/UX, załącz screenshoty lub GIF-y pokazujące zmiany.

### Przed:
<!-- Wklej screenshot -->

### Po:
<!-- Wklej screenshot -->

## 📊 Wyniki testów wydajności

Jeśli dotyczy wydajności, załącz wyniki Lighthouse:

| Metryka | Przed | Po |
|---------|-------|-----|
| Performance | _ | _ |
| Accessibility | _ | _ |
| Best Practices | _ | _ |
| SEO | _ | _ |

## 🔍 SEO Impact

Jeśli zmiany wpływają na SEO:

- [ ] Meta tags zostały zaktualizowane
- [ ] Schema.org markup został zaktualizowany
- [ ] Alt texts zostały dodane/zaktualizowane
- [ ] Open Graph tags zostały zaktualizowane
- [ ] Sitemap nie wymaga aktualizacji / został zaktualizowany
- [ ] Nie dotyczy

## ♿ Accessibility Check

- [ ] Alt text dla wszystkich obrazów
- [ ] ARIA labels gdzie potrzebne
- [ ] Kontrasty kolorów WCAG AA zgodne
- [ ] Nawigacja klawiaturą działa
- [ ] Screen reader tested
- [ ] Nie dotyczy

## 📱 Responsywność

Przetestowano na:

- [ ] Desktop (1920x1080, 1366x768)
- [ ] Laptop (1440x900, 1280x800)
- [ ] Tablet (768x1024, 1024x768)
- [ ] Mobile (375x667, 414x896, 360x640)
- [ ] Tryb poziomy (landscape)

## 🌐 Testowane przeglądarki

- [ ] Chrome (wersja: ___)
- [ ] Firefox (wersja: ___)
- [ ] Safari (wersja: ___)
- [ ] Edge (wersja: ___)
- [ ] Mobile Safari (wersja: ___)
- [ ] Chrome Android (wersja: ___)

## ✅ Checklist przed merge

### Kod

- [ ] Kod jest clean i zgodny z PSR-12
- [ ] Zmienne i funkcje mają sensowne nazwy
- [ ] Brak TODO/FIXME w kodzie (lub są w Issues)
- [ ] Brak console.log() / var_dump() / print_r()
- [ ] Brak zakomentowanego kodu (chyba że celowo z wyjaśnieniem)
- [ ] Kod jest optymalny (brak duplikacji, unnecessary queries)

### Dokumentacja

- [ ] Komentarze PHP (PHPDoc) dodane tam gdzie potrzebne
- [ ] README.md zaktualizowany (jeśli potrzebne)
- [ ] docs/ zaktualizowana (jeśli potrzebne)
- [ ] CHANGELOG.md zaktualizowany (jeśli potrzebne)
- [ ] Inline comments dla skomplikowanej logiki

### Testy

- [ ] Wszystkie testy przechodzą lokalnie
- [ ] GitHub Actions workflows przechodzą
- [ ] PHP Lint przechodzi
- [ ] CodeSniffer (PSR-12) przechodzi
- [ ] PHPStan przechodzi
- [ ] Lighthouse CI przechodzi

### Bezpieczeństwo

- [ ] Input validation dla wszystkich formularzy
- [ ] XSS protection (htmlspecialchars)
- [ ] CSRF tokens w formularzach
- [ ] SQL injection prevention (prepared statements)
- [ ] Brak hardcoded credentials
- [ ] .env używany dla wrażliwych danych
- [ ] Nie dotyczy

### Wydajność

- [ ] Obrazy zoptymalizowane (compressed, WebP)
- [ ] CSS/JS zminifikowane (jeśli dodane nowe)
- [ ] Lazy loading dla obrazów (jeśli dodane nowe)
- [ ] Brak N+1 queries (jeśli dotyczy DB)
- [ ] Cache wykorzystany gdzie możliwe
- [ ] Nie dotyczy

### Git

- [ ] Branch oparty na najnowszej wersji develop/main
- [ ] Commit messages są clear (Conventional Commits)
- [ ] Brak merge conflicts
- [ ] PR ma opisowy tytuł
- [ ] PR jest linked do Issue

## 🔄 Wpływ na istniejącą funkcjonalność

Czy te zmiany mogą wpłynąć na istniejącą funkcjonalność?

- [ ] Nie, to jest czysto addytywne
- [ ] Tak, ale w kontrolowany sposób (opisz poniżej)
- [ ] Wymaga aktualizacji dokumentacji użytkownika
- [ ] Wymaga aktualizacji środowiska produkcyjnego
- [ ] Wymaga migracji danych
- [ ] Breaking change (wymaga aktualizacji kodu)

**Opis wpływu:**
<!-- Jeśli tak, opisz szczegóły -->

## 🚀 Deployment notes

Specjalne instrukcje dla deployment:

- [ ] Wymaga aktualizacji .env
- [ ] Wymaga uruchomienia composer install
- [ ] Wymaga uruchomienia migracji DB
- [ ] Wymaga czyszczenia cache
- [ ] Wymaga restartu serwera
- [ ] Wymaga konfiguracji serwera (Apache/Nginx)
- [ ] Nie wymaga specjalnych kroków

**Dodatkowe instrukcje:**
```bash
# Wklej komendy jeśli potrzebne
```

## 📚 Dodatkowy kontekst

Dodaj wszelkie inne informacje kontekstowe o PR tutaj.

## 📝 Notatki dla reviewera

Wszelkie specjalne uwagi dla osoby przeglądającej ten PR:

---

## ✅ Finalna checklist

Potwierdź przed wysłaniem PR:

- [ ] Przeczytałem/am guidelines w CONTRIBUTING.md
- [ ] Mój kod jest zgodny z coding standards projektu
- [ ] Przeprowadziłem/am self-review własnego kodu
- [ ] Skomentowałem/am kod, szczególnie w trudnych obszarach
- [ ] Zaktualizowałem/am dokumentację
- [ ] Moje zmiany nie generują nowych ostrzeżeń
- [ ] Dodałem/am testy pokrywające moje zmiany
- [ ] Wszystkie nowe i istniejące testy przechodzą
- [ ] Przetestowałem/am na wielu przeglądarkach
- [ ] Przetestowałem/am responsywność
- [ ] Sprawdziłem/am accessibility

---

## 👀 Reviewers

@username - proszę o review tego PR

## 🏷️ Labels

<!-- Dodaj odpowiednie labels: bug, enhancement, documentation, etc. -->

---

**Thank you for contributing to Malarz Trzebnica! 🎨**

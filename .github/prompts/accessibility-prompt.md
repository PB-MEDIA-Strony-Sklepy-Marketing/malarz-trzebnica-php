# ♿ Accessibility Audit Prompt - WCAG 2.2 Level AA

**Wersja:** 1.0.0  
**Data:** 2024-12-15  
**Przeznaczenie:** Audyt dostępności (accessibility) zgodnie z WCAG 2.2 Level AA

---

## 🎯 Kontekst Projektu

**Website:** www.adwokat-trzebnica.com  
**Typ:** Strona informacyjna + formularz kontaktowy  
**Target:** WCAG 2.2 Level AA compliance  
**Cel:** Dostępność dla wszystkich użytkowników, w tym osób z niepełnosprawnościami

---

## 📋 WCAG 2.2 Principles (POUR)

### 1. 👁️ **Perceivable** - Treść musi być postrzegalna
### 2. ⌨️ **Operable** - Interfejs musi być operowalny
### 3. 🧠 **Understandable** - Treść i interfejs muszą być zrozumiałe
### 4. 💪 **Robust** - Treść musi być niezawodna i kompatybilna

---

## ✅ Accessibility Checklist

### 1. 🎨 Perceivable - Alternatywy Tekstowe

#### A. Images & Alt Text
- [ ] **Alt text:** Czy wszystkie obrazy mają atrybut `alt`?
- [ ] **Descriptive alt:** Czy alt text jest opisowy (nie "image1.jpg")?
- [ ] **Decorative images:** Czy obrazy dekoracyjne mają `alt=""`?
- [ ] **Complex images:** Czy złożone obrazy (wykresy) mają długi opis?
- [ ] **Logo:** Czy logo ma alt z nazwą kancelarii?

**❌ ŹLE:**
```html
<img src="lawyer.jpg">
<img src="logo.png" alt="logo">
<img src="decorative.svg" alt="decorative image">
```

**✅ DOBRZE:**
```html
<img src="lawyer.jpg" alt="Adwokat Katarzyna Maj w biurze kancelarii">
<img src="logo.png" alt="Kancelaria Adwokacka Katarzyna Maj">
<img src="decorative.svg" alt="">
```

#### B. Video & Audio
- [ ] Czy filmy mają napisy (captions)?
- [ ] Czy audio ma transkrypcje?
- [ ] Czy jest kontrola odtwarzania (play/pause)?
- [ ] Czy nie autoplay bez możliwości zatrzymania?

#### C. Color & Contrast
- [ ] **Contrast ratio:** Czy tekst ma kontrast min 4.5:1 (normal text)?
- [ ] **Large text:** Czy duży tekst (18pt+) ma kontrast min 3:1?
- [ ] **Color alone:** Czy informacje nie są przekazywane tylko kolorem?
- [ ] **Links:** Czy linki są rozpoznawalne nie tylko przez kolor?

**Test kontrastu:**
```
Narzędzia:
- WebAIM Contrast Checker
- Chrome DevTools (Accessibility panel)
- WAVE Extension
```

**Przykłady:**
```
✅ Czarny tekst (#000000) na białym tle (#FFFFFF) = 21:1 (Excellent)
✅ Ciemnoszary (#2B3139) na białym tle = 14.5:1 (Excellent)
✅ Złoty (#C4994F) na ciemnoszarym (#2B3139) = 4.8:1 (Pass AA)
❌ Jasnoszary (#A0AEC0) na białym tle = 2.3:1 (Fail)
```

---

### 2. ⌨️ Operable - Nawigacja Klawiaturą

#### A. Keyboard Navigation
- [ ] **Tab order:** Czy można nawigować Tab/Shift+Tab?
- [ ] **Logical order:** Czy kolejność tabulacji jest logiczna?
- [ ] **All interactive:** Czy wszystkie elementy interaktywne są dostępne z klawiatury?
- [ ] **No keyboard trap:** Czy użytkownik może wyjść z każdego elementu?
- [ ] **Skip links:** Czy istnieje "Skip to main content"?

**Test:** Spróbuj używać strony tylko z klawiatury (bez myszy):
```
Tab - Następny element
Shift+Tab - Poprzedni element
Enter - Aktywuj link/przycisk
Space - Zaznacz checkbox, aktywuj przycisk
Arrow keys - Nawigacja w radio/select
Esc - Zamknij dialog/menu
```

#### B. Focus Indicators
- [ ] **Visible focus:** Czy focus jest widoczny (outline)?
- [ ] **Contrast:** Czy focus ma kontrast min 3:1 z tłem?
- [ ] **Not removed:** Czy `outline: none` nie jest używane bez zamiennika?
- [ ] **Custom focus:** Jeśli custom focus, czy jest wystarczająco widoczny?

**❌ ŹLE:**
```css
*:focus {
    outline: none; /* NIE USUWAJ bez zamiennika! */
}
```

**✅ DOBRZE:**
```css
*:focus-visible {
    outline: 2px solid #C4994F;
    outline-offset: 2px;
}
```

#### C. Forms
- [ ] **Labels:** Czy wszystkie inputy mają `<label>`?
- [ ] **Associated:** Czy label jest powiązany z input (for/id)?
- [ ] **Required fields:** Czy wymagane pola są oznaczone (nie tylko kolorem)?
- [ ] **Error messages:** Czy błędy są wyraźnie oznaczone i opisane?
- [ ] **Instructions:** Czy instrukcje wypełniania są dostępne?

**❌ ŹLE:**
```html
<input type="text" placeholder="Imię">
<span style="color: red;">*</span> <!-- tylko kolor -->
```

**✅ DOBRZE:**
```html
<label for="name">Imię <span aria-label="wymagane">*</span></label>
<input type="text" id="name" required aria-required="true">

<!-- Lub -->
<label for="name">Imię (wymagane)</label>
<input type="text" id="name" required>
```

#### D. Time Limits
- [ ] Czy nie ma automatycznych timeoutów bez możliwości przedłużenia?
- [ ] Czy użytkownik jest ostrzegany przed timeoutem?
- [ ] Czy sesja może być przedłużona?

---

### 3. 💬 Understandable - Zrozumiałość

#### A. Language
- [ ] **Page language:** Czy `<html lang="pl">`?
- [ ] **Text language:** Czy fragmenty w innych językach mają `lang`?

```html
<html lang="pl">
  <p>Witamy w kancelarii.</p>
  <p lang="en">Welcome to our law office.</p>
</html>
```

#### B. Readable Text
- [ ] **Font size:** Czy tekst można powiększyć do 200% bez utraty funkcjonalności?
- [ ] **Line height:** Czy line-height min 1.5?
- [ ] **Paragraph spacing:** Czy spacing min 1.5x font size?
- [ ] **Justification:** Czy unikamy justyfikacji tekstu (text-align: justify)?

**✅ Zalecane:**
```css
body {
    font-size: 16px; /* Minimum dla body text */
    line-height: 1.5;
}

p {
    margin-bottom: 1.5em;
}
```

#### C. Clear Instructions
- [ ] Czy instrukcje formularzy są jasne?
- [ ] Czy komunikaty błędów są pomocne?
- [ ] Czy używamy prostego języka (no legalese bez wyjaśnień)?

**❌ ŹLE:**
```
Błąd: Nieprawidłowe dane wejściowe.
```

**✅ DOBRZE:**
```
Błąd: Pole "Email" musi zawierać prawidłowy adres email, 
np. jan.kowalski@example.com
```

#### D. Consistent Navigation
- [ ] Czy nawigacja jest spójna na wszystkich stronach?
- [ ] Czy elementy powtarzające się są w tym samym miejscu?
- [ ] Czy podobne elementy działają podobnie?

---

### 4. 🏗️ Robust - Solidność

#### A. Valid HTML
- [ ] Czy kod HTML jest valid (W3C Validator)?
- [ ] Czy nie ma duplikatów ID?
- [ ] Czy elementy są prawidłowo zagnieżdżone?
- [ ] Czy używamy semantic HTML5?

**✅ Semantic HTML:**
```html
<header>
  <nav aria-label="Nawigacja główna">
    <ul>...</ul>
  </nav>
</header>

<main>
  <article>
    <h1>Tytuł artykułu</h1>
    <p>Treść...</p>
  </article>
</main>

<aside aria-label="Informacje dodatkowe">
  ...
</aside>

<footer>
  ...
</footer>
```

#### B. ARIA (Accessible Rich Internet Applications)
- [ ] **ARIA landmarks:** Czy używane role dla głównych sekcji?
- [ ] **ARIA labels:** Czy używane dla elementów bez visible label?
- [ ] **ARIA live regions:** Czy dynamiczne treści są ogłaszane?
- [ ] **Not overused:** Czy ARIA nie jest nadużywane (HTML5 > ARIA)?

**Przykłady ARIA:**
```html
<!-- Nawigacja -->
<nav aria-label="Nawigacja główna">...</nav>

<!-- Przycisk bez tekstu (ikona) -->
<button aria-label="Zamknij menu">
  <span class="icon-close"></span>
</button>

<!-- Live region dla statusów formularza -->
<div role="status" aria-live="polite" aria-atomic="true">
  Formularz został wysłany pomyślnie.
</div>

<!-- Dialog/Modal -->
<div role="dialog" aria-labelledby="dialog-title" aria-modal="true">
  <h2 id="dialog-title">Potwierdzenie</h2>
  ...
</div>
```

#### C. Screen Reader Compatibility
Test ze screen readerami:
- [ ] NVDA (Windows - darmowy)
- [ ] JAWS (Windows - płatny)
- [ ] VoiceOver (macOS/iOS - built-in)
- [ ] TalkBack (Android - built-in)

**Sprawdź:**
- Czy wszystkie treści są odczytywane?
- Czy kolejność odczytu ma sens?
- Czy oznaczenia są zrozumiałe?
- Czy nawigacja jest możliwa?

---

## 🧪 Specific Component Checks

### Nawigacja Menu
```html
<nav aria-label="Nawigacja główna">
  <ul>
    <li><a href="/" aria-current="page">Strona główna</a></li>
    <li><a href="/uslugi">Usługi</a></li>
    <li>
      <button aria-expanded="false" aria-controls="submenu-uslugi">
        Obszary prawa
      </button>
      <ul id="submenu-uslugi">
        <li><a href="/prawo-rodzinne">Prawo rodzinne</a></li>
        ...
      </ul>
    </li>
  </ul>
</nav>
```

### Formularz Kontaktowy
```html
<form>
  <fieldset>
    <legend>Dane kontaktowe</legend>
    
    <div>
      <label for="name">Imię i nazwisko <span aria-label="wymagane">*</span></label>
      <input type="text" id="name" name="name" required 
             aria-required="true" aria-describedby="name-hint">
      <div id="name-hint">Podaj pełne imię i nazwisko</div>
    </div>
    
    <div>
      <label for="email">Email <span aria-label="wymagane">*</span></label>
      <input type="email" id="email" name="email" required
             aria-required="true" aria-describedby="email-hint">
      <div id="email-hint">np. jan.kowalski@example.com</div>
      <div id="email-error" role="alert" aria-live="assertive" class="hidden">
        <!-- Error message tutaj -->
      </div>
    </div>
    
    <div>
      <label for="message">Wiadomość <span aria-label="wymagane">*</span></label>
      <textarea id="message" name="message" required 
                aria-required="true" aria-describedby="message-hint"></textarea>
      <div id="message-hint">Min. 10 znaków</div>
    </div>
  </fieldset>
  
  <button type="submit">Wyślij wiadomość</button>
</form>
```

### Modals/Dialogs
```html
<div role="dialog" aria-modal="true" aria-labelledby="modal-title" 
     aria-describedby="modal-desc">
  <h2 id="modal-title">Sukces</h2>
  <p id="modal-desc">Wiadomość została wysłana pomyślnie.</p>
  <button aria-label="Zamknij okno">OK</button>
</div>
```

---

## 🛠️ Testing Tools

### Automated Tools (30% coverage)
- [ ] **WAVE Browser Extension** - Visual feedback
- [ ] **axe DevTools** - Chrome/Firefox extension
- [ ] **Lighthouse** (Chrome DevTools) - Accessibility audit
- [ ] **Pa11y** - Command-line tool
- [ ] **HTML Validator** - W3C Markup Validation Service

### Manual Testing (70% coverage)
- [ ] **Keyboard navigation** - Try using site with keyboard only
- [ ] **Screen reader** - Test with NVDA/VoiceOver
- [ ] **Zoom** - Test at 200% zoom
- [ ] **Color blindness** - Use simulators
- [ ] **Real users** - If possible, test with users with disabilities

---

## 📊 Accessibility Audit Report Template

### Overall Accessibility Score: __/100

| Category | Score | Status |
|----------|-------|--------|
| Perceivable | __/25 | ✅/⚠️/❌ |
| Operable | __/25 | ✅/⚠️/❌ |
| Understandable | __/25 | ✅/⚠️/❌ |
| Robust | __/25 | ✅/⚠️/❌ |

**WCAG 2.2 Level AA Compliance:** ✅ YES / ❌ NO

---

## 🚨 Critical Issues (Level A - Must Fix)

1. **[CRITICAL]** Missing alt text on images
2. **[CRITICAL]** Form inputs without labels
3. **[CRITICAL]** Insufficient color contrast
4. **[CRITICAL]** ...

---

## ⚠️ Major Issues (Level AA - Should Fix)

1. **[MAJOR]** Focus indicators not visible
2. **[MAJOR]** Missing ARIA labels
3. **[MAJOR]** ...

---

## 💡 Enhancements (Level AAA - Nice to Have)

1. **[ENHANCEMENT]** Increase contrast to AAA level (7:1)
2. **[ENHANCEMENT]** Add sign language videos
3. **[ENHANCEMENT]** ...

---

## 🎯 Remediation Priority

### Week 1 (Critical):
- [ ] Fix all alt text issues
- [ ] Add form labels
- [ ] Fix color contrast failures

### Week 2-3 (Major):
- [ ] Improve keyboard navigation
- [ ] Add focus indicators
- [ ] Fix ARIA issues

### Week 4+ (Enhancements):
- [ ] Implement skip links
- [ ] Add breadcrumbs
- [ ] Improve error messages

---

## 📚 Resources

**WCAG 2.2 Guidelines:**
- https://www.w3.org/WAI/WCAG22/quickref/

**Testing Tools:**
- WAVE: https://wave.webaim.org/
- axe DevTools: https://www.deque.com/axe/devtools/
- Color Contrast: https://webaim.org/resources/contrastchecker/

**Screen Readers:**
- NVDA (free): https://www.nvaccess.org/
- VoiceOver (Mac): Built into macOS
- TalkBack (Android): Built into Android

**Tutorials:**
- WebAIM: https://webaim.org/
- A11ycasts: https://www.youtube.com/playlist?list=PLNYkxOF6rcICWx0C9LVWWVqvHlYJyqw7g

---

## 🎓 AI Instructions

Jako AI accessibility auditor:

1. **Test systematically:** Przejdź przez wszystkie punkty checklista
2. **Be specific:** Wskaż konkretne elementy i ich problemy
3. **Provide solutions:** Pokaż jak naprawić każdy problem
4. **Prioritize:** Rozróżniaj Critical (Level A) od Major (Level AA)
5. **Think user-first:** Zawsze myśl o użytkowniku z niepełnosprawnością
6. **Test multiple ways:** Automated tools + manual + screen reader

**Example feedback:**
```
❌ PROBLEM (Critical - WCAG 2.2 Level A)
Page: /kontakt
Element: Contact form name input

Issue: Input field "Imię" nie ma powiązanego <label>

Current code:
<input type="text" name="name" placeholder="Wpisz imię">

Impact: Użytkownicy screen readerów nie wiedzą co wpisać w to pole.
WCAG: 3.3.2 Labels or Instructions (Level A)

Fix:
<label for="name">Imię</label>
<input type="text" id="name" name="name" placeholder="Wpisz imię">

lub z aria-label:
<input type="text" name="name" aria-label="Imię" placeholder="Wpisz imię">
```

---

**Ostatnia aktualizacja:** 2024-12-15  
**Standard:** WCAG 2.2 Level AA  
**Owner:** Kancelaria Adwokacka Katarzyna Maj

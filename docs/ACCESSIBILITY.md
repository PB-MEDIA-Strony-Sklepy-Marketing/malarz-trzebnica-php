# Accessibility (WCAG 2.1) - Malarz Trzebnica

## Standardy WCAG 2.1 Level AA

### 1. Perceivable (Postrzegalność)

#### Alt Texts dla Obrazów

```html
<!-- ✅ DOBRZE -->
<img src="malowanie-wnetrz.jpg" alt="Malowanie wnętrz - salon w kolorze beżowym">

<!-- ❌ ŹLE -->
<img src="image1.jpg" alt="">
```

#### Kontrast Kolorów

- **Text normalny:** Minimum 4.5:1
- **Text duży (18pt+):** Minimum 3:1
- **UI components:** Minimum 3:1

Narzędzie do sprawdzania: [WebAIM Contrast Checker](https://webaim.org/resources/contrastchecker/)

### 2. Operable (Obsługiwalność)

#### Keyboard Navigation

```html
<!-- Wszystkie interaktywne elementy dostępne z klawiatury -->
<button tabindex="0">Wyślij</button>
<a href="/kontakt" tabindex="0">Kontakt</a>

<!-- Skip to main content link -->
<a href="#main-content" class="skip-link">Przejdź do treści</a>
```

#### Focus Visible

```css
/* Widoczny focus dla keyboard users -->
a:focus, button:focus {
  outline: 2px solid #007bff;
  outline-offset: 2px;
}
```

### 3. Understandable (Zrozumiałość)

#### ARIA Labels

```html
<!-- Formularz kontaktowy -->
<form aria-label="Formularz kontaktowy">
  <label for="name">Imię i nazwisko</label>
  <input id="name" type="text" aria-required="true">
  
  <button type="submit" aria-label="Wyślij formularz kontaktowy">
    Wyślij
  </button>
</form>
```

#### Error Messages

```html
<input 
  id="email" 
  type="email" 
  aria-invalid="true"
  aria-describedby="email-error">
<span id="email-error" role="alert">
  Podaj prawidłowy adres email
</span>
```

### 4. Robust (Niezawodność)

#### Semantic HTML

```html
<!-- ✅ DOBRZE - semantic HTML5 -->
<header>
  <nav aria-label="Nawigacja główna">
    <ul>...</ul>
  </nav>
</header>

<main id="main-content">
  <article>
    <h1>Tytuł</h1>
  </article>
</main>

<footer>...</footer>
```

## Testing Accessibility

### Narzędzia

1. **axe DevTools** (Chrome Extension)
2. **WAVE** (Web Accessibility Evaluation Tool)
3. **Lighthouse Accessibility Audit**
4. **Screen Reader** (NVDA, JAWS)

### Checklist

- [ ] Wszystkie obrazy mają alt texts
- [ ] Kontrast kolorów spełnia WCAG AA
- [ ] Keyboard navigation działa
- [ ] Focus visible dla wszystkich interaktywnych elementów
- [ ] ARIA labels dla formularzy
- [ ] Semantic HTML5
- [ ] Form validation errors są announceowane
- [ ] Skip to content link
- [ ] Lang attribute w HTML
- [ ] Page title unique dla każdej strony

---
**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm

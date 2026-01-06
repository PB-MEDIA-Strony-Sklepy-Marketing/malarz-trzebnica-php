# UX Guidelines - Malarz Trzebnica

## User Journey

### 1. Landing (Strona Główna)

**Goal:** Przekonać użytkownika do kontaktu

**Flow:**
1. Hero section z CTA "Bezpłatna Wycena"
2. USP: Doświadczenie, profesjonalizm, konkurencyjne ceny
3. Portfolio (6 najnowszych realizacji)
4. Opinie klientów
5. Kontakt

**CTA Placement:**
- Above the fold (hero section)
- Po sekcji portfolio
- W footer (zawsze widoczny)

### 2. Galeria

**Goal:** Pokazać jakość pracy

**UX Features:**
- Lazy loading (szybkie ładowanie)
- Lightbox (pełnoekranowe zdjęcia)
- Kategorie filtrowania
- Hover effects (scale 1.05)

### 3. Kontakt

**Goal:** Maksymalizować konwersję formularza

**UX Features:**
- Tylko wymagane pola (imię, email, wiadomość)
- Inline validation
- Error messages jasne i pomocne
- Success message po wysłaniu
- Alternatywy: telefon, email bezpośrednio

## Mobile UX

### Touch Targets

- **Minimum:** 44x44px (Apple HIG)
- **Optimal:** 48x48px

```css
.btn {
  min-height: 44px;
  min-width: 44px;
  padding: 12px 24px;
}
```

### Mobile Menu

```html
<!-- Hamburger menu (< 992px) -->
<button class="navbar-toggler" aria-label="Menu">
  <span class="navbar-toggler-icon"></span>
</button>
```

## Performance UX

### Loading States

```html
<!-- Button loading state -->
<button class="btn btn-primary">
  <span class="btn-text">Wyślij</span>
  <span class="btn-spinner" style="display:none">
    <i class="spinner-border spinner-border-sm"></i>
  </span>
</button>
```

### Skeleton Screens

```css
/* Placeholder podczas ładowania galerii */
.skeleton {
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: loading 1.5s infinite;
}
```

## Micro-interactions

- Hover states (scale, color change)
- Smooth scrolling
- Form field focus animations
- Button click feedback

---
**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm

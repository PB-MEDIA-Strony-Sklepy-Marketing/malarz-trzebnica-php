# Monitoring - Malarz Trzebnica

## Google Analytics

### Setup

1. Utwórz konto Google Analytics
2. Uzyskaj Tracking ID (G-XXXXXXXXXX)
3. Dodaj do każdej strony przed `</head>`:

```html
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-XXXXXXXXXX');
</script>
```

### Cele do Śledzenia

- Kliknięcia "Bezpłatna Wycena"
- Wypełnienie formularza kontaktowego
- Kliknięcia telefon
- Wyświetlenia galerii
- Czas na stronie

## Google Search Console

### Setup

1. Dodaj właściwość www.malarz.trzebnica.pl
2. Weryfikuj przez meta tag lub Google Analytics
3. Prześlij sitemap.xml

### Monitorowanie

- Indeksowanie stron
- Wyszukiwania (słowa kluczowe)
- Pozycje w wynikach
- Błędy crawlingu

## Error Tracking (opcjonalnie - Sentry)

```html
<script src="https://browser.sentry-cdn.com/7.x.x/bundle.min.js"></script>
<script>
  Sentry.init({ 
    dsn: 'YOUR_DSN',
    environment: 'production'
  });
</script>
```

---
**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm

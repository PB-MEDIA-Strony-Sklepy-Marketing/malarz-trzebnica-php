# Prompt: Debugging - Malarz Trzebnica

## PHP Debugging

```php
// Włącz error reporting (tylko development)
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Xdebug configuration
xdebug.mode=debug
xdebug.client_host=localhost
xdebug.client_port=9003
```

## JavaScript Debugging

```javascript
// Console logging
console.log('Debug:', variable);
console.table(array);

// Breakpoints
debugger;

// Performance
console.time('operation');
// ... code ...
console.timeEnd('operation');
```

## Common Issues

1. **Formularz nie wysyła**
   - Sprawdź CSRF token
   - Walidacja email settings
   - Error logs w Apache/PHP

2. **Galeria nie ładuje**
   - Sprawdź ścieżki do obrazów
   - GLightbox initialized?
   - Network tab w DevTools

---
**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm

# Security Policy - Malarz Trzebnica

## Zgłaszanie Podatności

Jeśli odkryjesz lukę bezpieczeństwa w tym projekcie, prosimy o:

1. **NIE** tworzenia publicznego issue na GitHub
2. Wysłanie emaila na: kontakt@malarz.trzebnica.pl
3. Dołączenie szczegółów podatności:
   - Opis problemu
   - Kroki do reprodukcji
   - Potencjalny wpływ
   - Sugerowane rozwiązanie (jeśli masz)

## Odpowiedź

- Potwierdzimy otrzymanie zgłoszenia w ciągu 48 godzin
- Przeanalizujemy problem w ciągu 7 dni
- Naprawimy krytyczne problemy w ciągu 14 dni
- Poinformujemy Cię o postępach

## Wspierane Wersje

| Wersja | Wspierana |
|--------|-----------|
| 1.x    | ✅ Yes    |
| < 1.0  | ❌ No     |

## Polityka Bezpieczeństwa

### Implementowane Zabezpieczenia

- ✅ CSRF protection na wszystkich formularzach
- ✅ XSS prevention (htmlspecialchars)
- ✅ SQL injection prevention (prepared statements)
- ✅ Rate limiting
- ✅ Secure headers (CSP, X-Frame-Options)
- ✅ Input validation
- ✅ HTTPS required

### Najlepsze Praktyki

- Wszystkie credentials w .env (nie commitowane)
- Regular updates dependencies
- Security headers w .htaccess
- Error logs nie zawierają sensitive data

---
**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm

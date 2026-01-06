# Testing - Malarz Trzebnica PHP

## Strategia Testowania

### Typy Testów
- **Unit Tests** - PHPUnit dla logiki biznesowej
- **Integration Tests** - testy formularza kontaktowego
- **E2E Tests** - testy interfejsu użytkownika

### PHPUnit Configuration

```bash
# Uruchomienie testów
composer test

# Z coverage
composer test:coverage
```

### Przykład Testu

```php
<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Services\ValidationService;

class ValidationServiceTest extends TestCase
{
    public function testEmailValidation(): void
    {
        $validator = new ValidationService();
        $this->assertTrue($validator->isValidEmail('test@example.com'));
        $this->assertFalse($validator->isValidEmail('invalid-email'));
    }
}
```

---
**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm

# Prompt: Formularz Kontaktowy z Zabezpieczeniami - Malarz Trzebnica

## Zadanie

Zaimplementuj bezpieczny formularz kontaktowy z walidacją PHP i zabezpieczeniami przed spamem.

## Struktura HTML Formularza

```html
<form id="contactForm" method="POST" action="/kontakt/wyslij" class="contact-form">
  <!-- CSRF Token -->
  <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
  
  <!-- Honeypot (hidden field for bots) -->
  <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">
  
  <div class="form-group">
    <label for="name">Imię i nazwisko <span class="required">*</span></label>
    <input type="text" 
           id="name" 
           name="name" 
           class="form-control" 
           required 
           minlength="2"
           maxlength="100">
    <span class="error-message" id="name-error"></span>
  </div>
  
  <div class="form-group">
    <label for="email">Email <span class="required">*</span></label>
    <input type="email" 
           id="email" 
           name="email" 
           class="form-control" 
           required>
    <span class="error-message" id="email-error"></span>
  </div>
  
  <div class="form-group">
    <label for="phone">Telefon</label>
    <input type="tel" 
           id="phone" 
           name="phone" 
           class="form-control" 
           pattern="[0-9+\s\-()]{9,15}">
    <span class="error-message" id="phone-error"></span>
  </div>
  
  <div class="form-group">
    <label for="message">Wiadomość <span class="required">*</span></label>
    <textarea id="message" 
              name="message" 
              class="form-control" 
              required 
              minlength="10"
              maxlength="1000"
              rows="6"></textarea>
    <span class="error-message" id="message-error"></span>
  </div>
  
  <div class="form-group form-check">
    <input type="checkbox" 
           id="consent" 
           name="consent" 
           class="form-check-input" 
           required>
    <label for="consent" class="form-check-label">
      Zgadzam się na przetwarzanie moich danych osobowych zgodnie z 
      <a href="/polityka-prywatnosci">polityką prywatności</a> *
    </label>
  </div>
  
  <button type="submit" class="btn btn-primary btn-lg">
    <span class="btn-text">Wyślij wiadomość</span>
    <span class="btn-spinner" style="display:none">
      <i class="spinner-border spinner-border-sm"></i> Wysyłanie...
    </span>
  </button>
  
  <div class="alert alert-success" id="success-message" style="display:none">
    Dziękujemy za wiadomość! Odpowiemy najszybciej jak to możliwe.
  </div>
  
  <div class="alert alert-danger" id="error-message" style="display:none">
    Wystąpił błąd podczas wysyłania. Spróbuj ponownie.
  </div>
</form>
```

## Kontroler ContactController

```php
<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Services\EmailService;
use App\Services\ValidationService;
use App\Core\Security;

class ContactController extends Controller
{
    private EmailService $emailService;
    private ValidationService $validator;
    
    public function __construct()
    {
        $this->emailService = new EmailService();
        $this->validator = new ValidationService();
    }
    
    public function index(): void
    {
        // Generuj CSRF token
        $csrf_token = Security::generateCsrfToken();
        
        $data = [
            'title' => 'Kontakt - Malarz Trzebnica',
            'description' => 'Skontaktuj się z nami - bezpłatna wycena',
            'csrf_token' => $csrf_token,
        ];
        
        $this->render('pages/contact', $data);
    }
    
    public function send(): void
    {
        // Sprawdź metodę HTTP
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            exit;
        }
        
        try {
            // 1. Walidacja CSRF token
            if (!Security::validateCsrfToken($_POST['csrf_token'] ?? '')) {
                throw new \Exception('Invalid CSRF token');
            }
            
            // 2. Honeypot check (bot detection)
            if (!empty($_POST['website'])) {
                // Bot detected - silent fail
                http_response_code(200);
                echo json_encode(['success' => true]);
                exit;
            }
            
            // 3. Rate limiting
            if (!Security::checkRateLimit($_SERVER['REMOTE_ADDR'], 5, 60)) {
                throw new \Exception('Too many requests. Please try again later.');
            }
            
            // 4. Sanitize and validate input
            $name = $this->validator->sanitize($_POST['name'] ?? '');
            $email = $this->validator->sanitizeEmail($_POST['email'] ?? '');
            $phone = $this->validator->sanitize($_POST['phone'] ?? '');
            $message = $this->validator->sanitize($_POST['message'] ?? '');
            $consent = isset($_POST['consent']) && $_POST['consent'] === 'on';
            
            // 5. Validation rules
            $errors = [];
            
            if (empty($name) || strlen($name) < 2) {
                $errors['name'] = 'Imię musi mieć minimum 2 znaki';
            }
            
            if (!$this->validator->isValidEmail($email)) {
                $errors['email'] = 'Podaj prawidłowy adres email';
            }
            
            if (!empty($phone) && !$this->validator->isValidPhone($phone)) {
                $errors['phone'] = 'Podaj prawidłowy numer telefonu';
            }
            
            if (empty($message) || strlen($message) < 10) {
                $errors['message'] = 'Wiadomość musi mieć minimum 10 znaków';
            }
            
            if (!$consent) {
                $errors['consent'] = 'Wymagana zgoda na przetwarzanie danych';
            }
            
            if (!empty($errors)) {
                http_response_code(400);
                echo json_encode(['errors' => $errors]);
                exit;
            }
            
            // 6. Prepare email
            $emailBody = $this->prepareEmailBody([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'message' => $message,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'timestamp' => date('Y-m-d H:i:s'),
            ]);
            
            // 7. Send email
            $sent = $this->emailService->send(
                config('mail.to'),
                'Nowa wiadomość z formularza kontaktowego - Malarz Trzebnica',
                $emailBody,
                ['email' => $email, 'name' => $name]
            );
            
            if (!$sent) {
                throw new \Exception('Failed to send email');
            }
            
            // 8. Send auto-reply to user
            $autoReply = $this->prepareAutoReply($name);
            $this->emailService->send(
                $email,
                'Dziękujemy za kontakt - Malarz Trzebnica',
                $autoReply,
                config('mail.from')
            );
            
            // 9. Success response
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'message' => 'Wiadomość została wysłana. Odpowiemy najszybciej jak to możliwe.',
            ]);
            
        } catch (\Exception $e) {
            // Log error
            error_log('Contact form error: ' . $e->getMessage());
            
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Wystąpił błąd. Spróbuj ponownie lub skontaktuj się telefonicznie.',
            ]);
        }
        
        exit;
    }
    
    private function prepareEmailBody(array $data): string
    {
        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #007bff; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #555; }
        .value { color: #333; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Nowa wiadomość z formularza kontaktowego</h2>
        </div>
        <div class="content">
            <div class="field">
                <span class="label">Imię i nazwisko:</span>
                <span class="value">{$data['name']}</span>
            </div>
            <div class="field">
                <span class="label">Email:</span>
                <span class="value">{$data['email']}</span>
            </div>
            <div class="field">
                <span class="label">Telefon:</span>
                <span class="value">{$data['phone']}</span>
            </div>
            <div class="field">
                <span class="label">Wiadomość:</span>
                <div class="value">{nl2br($data['message'])}</div>
            </div>
            <hr>
            <div class="field">
                <span class="label">IP:</span>
                <span class="value">{$data['ip']}</span>
            </div>
            <div class="field">
                <span class="label">Data:</span>
                <span class="value">{$data['timestamp']}</span>
            </div>
        </div>
    </div>
</body>
</html>
HTML;
    }
    
    private function prepareAutoReply(string $name): string
    {
        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <p>Dzień dobry {$name},</p>
    
    <p>Dziękujemy za kontakt z firmą Malarz Trzebnica.</p>
    
    <p>Twoja wiadomość została otrzymana i odpowiemy na nią w ciągu 24 godzin.</p>
    
    <p>W przypadku pilnych spraw prosimy o kontakt telefoniczny:<br>
    <strong>☎ +48 452 690 824</strong></p>
    
    <p>Pozdrawiamy,<br>
    Zespół Malarz Trzebnica<br>
    <em>Precision, Perfection, Professional</em></p>
</body>
</html>
HTML;
    }
}
```

## Walidacja i Zabezpieczenia (ValidationService)

```php
<?php
namespace App\Services;

class ValidationService
{
    public function sanitize(string $input): string
    {
        // Usuń białe znaki z początku i końca
        $input = trim($input);
        
        // Usuń HTML/PHP tags
        $input = strip_tags($input);
        
        // Konwertuj special characters
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        
        return $input;
    }
    
    public function sanitizeEmail(string $email): string
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }
    
    public function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    public function isValidPhone(string $phone): bool
    {
        // Polskie numery telefonu
        $pattern = '/^[\+]?[(]?[0-9]{2,3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{3}$/';
        return preg_match($pattern, $phone) === 1;
    }
}
```

## JavaScript - AJAX Submit

```javascript
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('contactForm');
  const submitBtn = form.querySelector('button[type="submit"]');
  const btnText = submitBtn.querySelector('.btn-text');
  const btnSpinner = submitBtn.querySelector('.btn-spinner');
  
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    // Clear previous errors
    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
    document.getElementById('success-message').style.display = 'none';
    document.getElementById('error-message').style.display = 'none';
    
    // Show loading
    btnText.style.display = 'none';
    btnSpinner.style.display = 'inline-block';
    submitBtn.disabled = true;
    
    // Prepare form data
    const formData = new FormData(form);
    
    try {
      const response = await fetch('/kontakt/wyslij', {
        method: 'POST',
        body: formData,
      });
      
      const data = await response.json();
      
      if (response.ok && data.success) {
        // Success
        document.getElementById('success-message').style.display = 'block';
        form.reset();
      } else if (data.errors) {
        // Validation errors
        Object.keys(data.errors).forEach(field => {
          const errorEl = document.getElementById(`${field}-error`);
          if (errorEl) {
            errorEl.textContent = data.errors[field];
          }
        });
      } else {
        // Server error
        document.getElementById('error-message').style.display = 'block';
      }
    } catch (error) {
      console.error('Form submission error:', error);
      document.getElementById('error-message').style.display = 'block';
    } finally {
      // Hide loading
      btnText.style.display = 'inline';
      btnSpinner.style.display = 'none';
      submitBtn.disabled = false;
    }
  });
});
```

## Akcje

1. Utwórz `ContactController` w `dist/app/Controllers/`
2. Utwórz `ValidationService` w `dist/app/Services/`
3. Utwórz `Security` class w `dist/core/` (CSRF, rate limiting)
4. Dodaj routing dla POST `/kontakt/wyslij`
5. Zaimplementuj EmailService z PHPMailer
6. Przetestuj wszystkie zabezpieczenia
7. Dodaj unit testy dla walidacji

---
**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm

# API Documentation - Malarz Trzebnica

Kompletna dokumentacja REST API formularza kontaktu i galerii projektu **Malarz Trzebnica**.

**Base URL:** `https://www.malarz.trzebnica.pl/api`

**Autentykacja:** Brak (publiczne API)

**Rate Limit:** 10 żądań na godzinę na IP

---

## 1. Wstęp

### Konwencje

- **Base URL**: `https://www.malarz.trzebnica.pl/api`
- **Format**: JSON
- **Metody HTTP**: GET, POST, PUT, DELETE
- **Content-Type**: `application/json`
- **Status Codes**: HTTP standard (200, 201, 400, 404, 500)

### Versioning

API nie ma wersjonowania w URL (czystość URL'i). Zmiany backward compatible.

```
GET /api/kontakt
GET /api/galeria
POST /api/wiadomosc
```

### Errors

Wszystkie błędy zwracają JSON:

```json
{
  "success": false,
  "error": "Opis błędu",
  "error_code": "VALIDATION_ERROR",
  "details": {
    "field": ["error message"]
  }
}
```

### Success Response

```json
{
  "success": true,
  "message": "Operacja powiodła się",
  "data": {}
}
```

---

## 2. Endpoints

### 2.1 Formularz Kontaktu

#### POST /api/kontakt

Wyślij wiadomość kontaktową.

**URL:** `https://www.malarz.trzebnica.pl/api/kontakt`

**Metoda:** `POST`

**Headers:**
```
Content-Type: application/json
```

**Request Body:**

```json
{
  "imie": "Jan",
  "email": "jan.kowalski@example.com",
  "telefon": "+48 123 456 789",
  "temat": "Wycena malowania pokoju",
  "wiadomosc": "Chciałbym wycenę na malowanie pokoju 4x5 metrów",
  "_csrf_token": "token_string"
}
```

**Query Parameters:**
```
GET /api/kontakt?lang=pl
GET /api/kontakt?lang=en
```

**Request Fields:**

| Field | Type | Required | Validation | Description |
|-------|------|----------|------------|-------------|
| imie | string | ✅ | min: 2, max: 100 | Imię i nazwisko |
| email | string | ✅ | valid email | Adres email |
| telefon | string | ❌ | valid phone | Numer telefonu |
| temat | string | ✅ | min: 5, max: 200 | Temat wiadomości |
| wiadomosc | string | ✅ | min: 10, max: 5000 | Treść wiadomości |
| _csrf_token | string | ✅ | valid token | CSRF protection token |

**Response 201 - Success:**

```json
{
  "success": true,
  "message": "Wiadomość wysłana pomyślnie",
  "data": {
    "id": 42,
    "created_at": "2024-01-15T10:30:00Z",
    "reference_number": "REF-2024-001234"
  }
}
```

**Response 422 - Validation Error:**

```json
{
  "success": false,
  "error": "Błąd walidacji",
  "error_code": "VALIDATION_ERROR",
  "details": {
    "email": ["Email musi być poprawnym adresem"],
    "wiadomosc": ["Wiadomość musi mieć co najmniej 10 znaków"]
  }
}
```

**Response 429 - Rate Limited:**

```json
{
  "success": false,
  "error": "Za dużo żądań. Spróbuj ponownie za kilka minut.",
  "error_code": "RATE_LIMITED",
  "retry_after": 3600
}
```

**Response 500 - Server Error:**

```json
{
  "success": false,
  "error": "Wewnętrzny błąd serwera",
  "error_code": "INTERNAL_ERROR"
}
```

**cURL Example:**

```bash
curl -X POST https://www.malarz.trzebnica.pl/api/kontakt \
  -H "Content-Type: application/json" \
  -d '{
    "imie": "Jan Kowalski",
    "email": "jan@example.com",
    "temat": "Wycena usługi",
    "wiadomosc": "Chciałbym wycenę na malowanie pokoju",
    "_csrf_token": "token123"
  }'
```

**JavaScript Example:**

```javascript
const sendMessage = async () => {
  try {
    const response = await fetch('/api/kontakt', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        imie: 'Jan Kowalski',
        email: 'jan@example.com',
        temat: 'Wycena usługi',
        wiadomosc: 'Chciałbym wycenę...',
        _csrf_token: document.querySelector('input[name="_csrf_token"]').value
      })
    });
    
    const data = await response.json();
    
    if (data.success) {
      console.log('Wiadomość wysłana:', data.data.reference_number);
    } else {
      console.error('Błąd:', data.details);
    }
  } catch (error) {
    console.error('Błąd sieci:', error);
  }
};
```

**PHP Example:**

```php
<?php
$data = [
    'imie' => 'Jan Kowalski',
    'email' => 'jan@example.com',
    'temat' => 'Wycena usługi',
    'wiadomosc' => 'Chciałbym wycenę na malowanie pokoju',
    '_csrf_token' => $_SESSION['_csrf_token']
];

$ch = curl_init('https://www.malarz.trzebnica.pl/api/kontakt');

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_SSL_VERIFYHOST => 2
]);

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if ($result['success']) {
    echo "Numer referencyjny: " . $result['data']['reference_number'];
}
?>
```

**Python Example:**

```python
import requests
import json

url = 'https://www.malarz.trzebnica.pl/api/kontakt'

data = {
    'imie': 'Jan Kowalski',
    'email': 'jan@example.com',
    'temat': 'Wycena usługi',
    'wiadomosc': 'Chciałbym wycenę na malowanie pokoju',
    '_csrf_token': csrf_token
}

headers = {
    'Content-Type': 'application/json'
}

response = requests.post(url, json=data, headers=headers)
result = response.json()

if result['success']:
    print(f"Reference: {result['data']['reference_number']}")
else:
    print(f"Errors: {result['details']}")
```

---

### 2.2 Galeria

#### GET /api/galeria

Pobierz listę projektów z galerii.

**URL:** `https://www.malarz.trzebnica.pl/api/galeria`

**Metoda:** `GET`

**Query Parameters:**

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| kategoria | string | all | Filtruj po kategorii (malowanie-wnetrz, szpachlowanie, etc) |
| limit | integer | 12 | Liczba projektów do pobrania (max 100) |
| offset | integer | 0 | Offset dla paginacji |
| sort | string | newest | Sortowanie: newest, oldest, popular |
| search | string | - | Wyszukaj po nazwie |

**Response 200 - Success:**

```json
{
  "success": true,
  "data": {
    "total": 24,
    "count": 12,
    "offset": 0,
    "projects": [
      {
        "id": 1,
        "nazwa": "Malowanie salonu",
        "opis": "Profesjonalne malowanie salonu domowego",
        "kategoria": "malowanie-wnetrz",
        "zdjecia": [
          {
            "id": 101,
            "sciezka_plik": "/assets/images/galeria/projekt-1.jpg",
            "miniatura": "/assets/images/galeria/projekt-1-thumb.jpg",
            "tytul": "Salon - Przed",
            "alt_text": "Malowanie salonu - Trzebnica"
          },
          {
            "id": 102,
            "sciezka_plik": "/assets/images/galeria/projekt-2.jpg",
            "miniatura": "/assets/images/galeria/projekt-2-thumb.jpg",
            "tytul": "Salon - Po",
            "alt_text": "Salon po malowaniu"
          }
        ],
        "created_at": "2024-01-10T08:00:00Z",
        "views": 245
      },
      {
        "id": 2,
        "nazwa": "Szpachlowanie ścian",
        "opis": "Szpachlowanie i wyrównywanie ścian",
        "kategoria": "szpachlowanie",
        "zdjecia": [...],
        "created_at": "2024-01-09T10:00:00Z",
        "views": 189
      }
    ],
    "categories": [
      {
        "id": 1,
        "nazwa": "Malowanie Wnętrz",
        "slug": "malowanie-wnetrz",
        "count": 8
      },
      {
        "id": 2,
        "nazwa": "Szpachlowanie",
        "slug": "szpachlowanie",
        "count": 5
      }
    ]
  }
}
```

**cURL Example:**

```bash
# Pobierz wszystkie projekty
curl https://www.malarz.trzebnica.pl/api/galeria

# Filtruj po kategorii
curl "https://www.malarz.trzebnica.pl/api/galeria?kategoria=malowanie-wnetrz"

# Wyszukaj
curl "https://www.malarz.trzebnica.pl/api/galeria?search=salon"

# Paginacja
curl "https://www.malarz.trzebnica.pl/api/galeria?limit=20&offset=0"
```

**JavaScript Example:**

```javascript
const fetchGallery = async (kategoria = null) => {
  let url = '/api/galeria';
  
  if (kategoria) {
    url += `?kategoria=${encodeURIComponent(kategoria)}`;
  }
  
  const response = await fetch(url);
  const data = await response.json();
  
  console.log(`Znaleziono ${data.data.total} projektów`);
  data.data.projects.forEach(project => {
    console.log(`- ${project.nazwa} (${project.zdjecia.length} zdjęć)`);
  });
};

fetchGallery('malowanie-wnetrz');
```

---

### 2.3 Projekt Szczegóły

#### GET /api/galeria/{id}

Pobierz szczegóły konkretnego projektu.

**URL:** `https://www.malarz.trzebnica.pl/api/galeria/1`

**Metoda:** `GET`

**Response 200 - Success:**

```json
{
  "success": true,
  "data": {
    "id": 1,
    "nazwa": "Malowanie salonu w domu",
    "opis": "Kompleksowe malowanie salonu domowego",
    "kategoria": "malowanie-wnetrz",
    "powierzchnia": "25m²",
    "czas_wykonania": "2 dni",
    "data_utworzenia": "2024-01-10T08:00:00Z",
    "views": 245,
    "rating": 4.8,
    "reviews_count": 12,
    "zdjecia": [
      {
        "id": 101,
        "sciezka_plik": "/assets/images/galeria/projekt-1.jpg",
        "miniatura": "/assets/images/galeria/projekt-1-thumb.jpg",
        "tytul": "Salon - Przed",
        "opis": "Stan pomieszczeń przed malowaniem",
        "alt_text": "Salon przed malowaniem",
        "kolejnosc": 1
      }
    ],
    "materials": {
      "farba": "Tikkurila Luja 20L",
      "grunt": "Tikkurila Otex Primer",
      "sprzet": "Wałki, pędzle, ściernica"
    },
    "timeline": {
      "poczatek": "2024-01-10",
      "koniec": "2024-01-12"
    }
  }
}
```

**Response 404 - Not Found:**

```json
{
  "success": false,
  "error": "Projekt nie znaleziony",
  "error_code": "NOT_FOUND"
}
```

---

### 2.4 Kategorie

#### GET /api/kategorie

Pobierz listę dostępnych kategorii.

**URL:** `https://www.malarz.trzebnica.pl/api/kategorie`

**Metoda:** `GET`

**Response 200 - Success:**

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nazwa": "Malowanie Wnętrz",
      "slug": "malowanie-wnetrz",
      "opis": "Profesjonalne malowanie pomieszczeń mieszkalnych i komercyjnych",
      "ikona": "paint-brush",
      "count": 8
    },
    {
      "id": 2,
      "nazwa": "Szpachlowanie",
      "slug": "szpachlowanie",
      "opis": "Wyrównywanie i szpachlowanie ścian",
      "ikona": "wrench",
      "count": 5
    },
    {
      "id": 3,
      "nazwa": "Gładź Gipsowa",
      "slug": "gk",
      "opis": "Montaż i wykończenie gładzi gipsowych",
      "ikona": "wall",
      "count": 3
    }
  ]
}
```

---

## 3. Implementacja API w Kontrolerze

### 3.1 Kontroler API

**Plik: src/Controllers/ApiController.php**

```php
<?php
namespace App\Controllers;

use App\Core\Validator;
use App\Core\Csrf;
use App\Core\RateLimiter;
use App\Core\Sanitizer;
use App\Models\Projekt;
use App\Models\Zdjecie;

class ApiController extends BaseController
{
    /**
     * POST /api/kontakt
     * Formularz kontaktu
     */
    public function kontakt()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            $this->json(['error' => 'Metoda nie dozwolona'], 405);
        }
        
        // Rate limiting
        $limiter = new RateLimiter();
        $clientIp = $_SERVER['REMOTE_ADDR'];
        
        if (!$limiter->allow("api_kontakt_$clientIp", 10, 60)) {
            http_response_code(429);
            $this->json([
                'error' => 'Za dużo żądań',
                'retry_after' => 3600
            ], 429);
        }
        
        // Pobierz JSON body
        $input = json_decode(file_get_contents('php://input'), true);
        
        // Waliduj dane
        $validator = new Validator($input ?? []);
        $validator->required('imie', 'Imię jest wymagane')
                  ->minLength('imie', 2)
                  ->maxLength('imie', 100)
                  ->required('email')
                  ->email('email')
                  ->required('temat')
                  ->minLength('temat', 5)
                  ->maxLength('temat', 200)
                  ->required('wiadomosc')
                  ->minLength('wiadomosc', 10)
                  ->maxLength('wiadomosc', 5000);
        
        if ($validator->fails()) {
            http_response_code(422);
            $this->json([
                'error' => 'Błąd walidacji',
                'error_code' => 'VALIDATION_ERROR',
                'details' => $validator->getErrors()
            ], 422);
        }
        
        // Sanitize dane
        $data = [
            'imie' => Sanitizer::text($input['imie']),
            'email' => Sanitizer::email($input['email']),
            'telefon' => Sanitizer::text($input['telefon'] ?? ''),
            'temat' => Sanitizer::text($input['temat']),
            'wiadomosc' => Sanitizer::html($input['wiadomosc']),
            'ip_adres' => $clientIp,
        ];
        
        // Zapisz do bazy
        try {
            $this->db->query(
                'INSERT INTO wiadomosci (imie, email, telefon, temat, wiadomosc, ip_adres, data_dodania) 
                 VALUES (?, ?, ?, ?, ?, ?, NOW())',
                [
                    $data['imie'],
                    $data['email'],
                    $data['telefon'],
                    $data['temat'],
                    $data['wiadomosc'],
                    $data['ip_adres']
                ]
            );
            
            $messageId = $this->db->lastInsertId();
            $referenceNumber = 'REF-' . date('Y') . '-' . str_pad($messageId, 6, '0', STR_PAD_LEFT);
            
            // Wyślij email potwierdzenia
            $this->sendConfirmationEmail($data['email'], $data['imie'], $referenceNumber);
            
            // Wyślij email do administratora
            $this->sendAdminEmail($data, $referenceNumber);
            
            http_response_code(201);
            $this->json([
                'success' => true,
                'message' => 'Wiadomość wysłana pomyślnie',
                'data' => [
                    'id' => $messageId,
                    'reference_number' => $referenceNumber,
                    'created_at' => date('c')
                ]
            ]);
        } catch (\Exception $e) {
            error_log('Błąd wysyłania formularza: ' . $e->getMessage());
            
            http_response_code(500);
            $this->json([
                'error' => 'Błąd podczas przetwarzania',
                'error_code' => 'INTERNAL_ERROR'
            ], 500);
        }
    }
    
    /**
     * GET /api/galeria
     * Lista projektów
     */
    public function galeria()
    {
        $kategoria = $_GET['kategoria'] ?? null;
        $limit = intval($_GET['limit'] ?? 12);
        $offset = intval($_GET['offset'] ?? 0);
        $search = $_GET['search'] ?? null;
        $sort = $_GET['sort'] ?? 'newest';
        
        // Limit max 100
        $limit = min($limit, 100);
        
        $projektModel = new Projekt($this->db);
        
        // Pobierz projekty
        if ($kategoria) {
            $projekty = $projektModel->getByKategoriaWithZdjecia($kategoria);
        } else {
            $projekty = $projektModel->getAllWithZdjecia();
        }
        
        // Filter po search
        if ($search) {
            $search = strtolower($search);
            $projekty = array_filter($projekty, function($p) use ($search) {
                return strpos(strtolower($p['nazwa']), $search) !== false ||
                       strpos(strtolower($p['opis']), $search) !== false;
            });
        }
        
        // Sortowanie
        usort($projekty, function($a, $b) use ($sort) {
            if ($sort === 'oldest') {
                return strtotime($a['data_utworzenia']) - strtotime($b['data_utworzenia']);
            } else {
                return strtotime($b['data_utworzenia']) - strtotime($a['data_utworzenia']);
            }
        });
        
        // Pobierz kategorie
        $this->db->query('SELECT * FROM kategorie ORDER BY kolejnosc ASC');
        $kategorie = $this->db->getAll();
        
        // Paginacja
        $total = count($projekty);
        $projekty = array_slice($projekty, $offset, $limit);
        
        // Formatuj odpowiedź
        $formattedProjects = array_map(function($p) {
            return [
                'id' => $p['id'],
                'nazwa' => htmlspecialchars($p['nazwa']),
                'opis' => htmlspecialchars(substr($p['opis'], 0, 200)),
                'kategoria' => htmlspecialchars($p['kategoria']),
                'zdjecia' => array_map(function($z) {
                    return [
                        'id' => $z['id'],
                        'sciezka_plik' => $z['sciezka_plik'],
                        'miniatura' => $z['miniatura'],
                        'tytul' => htmlspecialchars($z['tytul'] ?? ''),
                        'alt_text' => htmlspecialchars($z['alt_text'] ?? '')
                    ];
                }, $p['zdjecia'] ?? []),
                'created_at' => $p['data_utworzenia'],
                'views' => $p['views'] ?? 0
            ];
        }, $projekty);
        
        $this->json([
            'success' => true,
            'data' => [
                'total' => $total,
                'count' => count($formattedProjects),
                'offset' => $offset,
                'projects' => $formattedProjects,
                'categories' => $kategorie
            ]
        ]);
    }
    
    /**
     * GET /api/kategorie
     * Lista kategorii
     */
    public function kategorie()
    {
        $this->db->query('SELECT * FROM kategorie ORDER BY kolejnosc ASC');
        $kategorie = $this->db->getAll();
        
        // Dodaj count zdjęć
        foreach ($kategorie as &$kat) {
            $this->db->query(
                'SELECT COUNT(*) as count FROM projekty WHERE kategoria = ?',
                [$kat['nazwa']]
            );
            $count = $this->db->single();
            $kat['count'] = $count['count'] ?? 0;
        }
        
        $this->json([
            'success' => true,
            'data' => $kategorie
        ]);
    }
    
    // Helper methods
    
    private function sendConfirmationEmail($email, $imie, $referenceNumber)
    {
        $subject = "Potwierdzenie: Twoja wiadomość została wysłana";
        
        $message = "Witaj $imie,\n\n";
        $message .= "Dziękujemy za kontakt! Twoja wiadomość została wysłana pomyślnie.\n\n";
        $message .= "Numer referencyjny: $referenceNumber\n";
        $message .= "Odpowiemy w ciągu 24 godzin.\n\n";
        $message .= "Pozdrawiamy,\nZespół Malarz Trzebnica\n";
        $message .= "Tel: +48 452 690 824\n";
        
        $headers = [
            'From: kontakt@malarz.trzebnica.pl',
            'Content-Type: text/plain; charset=UTF-8'
        ];
        
        mail($email, $subject, $message, implode("\r\n", $headers));
    }
    
    private function sendAdminEmail($data, $referenceNumber)
    {
        $subject = "Nowa wiadomość z formularza kontaktu";
        
        $message = "Nowa wiadomość z formularza:\n\n";
        $message .= "Numer referencyjny: $referenceNumber\n";
        $message .= "Imię: {$data['imie']}\n";
        $message .= "Email: {$data['email']}\n";
        $message .= "Telefon: {$data['telefon']}\n";
        $message .= "Temat: {$data['temat']}\n";
        $message .= "Wiadomość:\n{$data['wiadomosc']}\n\n";
        $message .= "IP: {$data['ip_adres']}\n";
        
        mail('kontakt@malarz.trzebnica.pl', $subject, $message);
    }
}
```

---

## 4. Routing

**Plik: config/routes.php**

```php
<?php

use App\Core\Router;

$router = new Router();

// API endpoints
$router->post('/api/kontakt', 'ApiController@kontakt');
$router->get('/api/galeria', 'ApiController@galeria');
$router->get('/api/kategorie', 'ApiController@kategorie');

return $router;
```

---

## 5. Authentication (Future)

Dla przyszłych wersji z autentykacją:

```
Authorization: Bearer token_string

POST /api/admin/projekty
POST /api/admin/zdjecia
PUT /api/admin/projekty/{id}
DELETE /api/admin/projekty/{id}
```

---

## 6. Status Codes

| Code | Meaning | Description |
|------|---------|-------------|
| 200 | OK | Żądanie powiodło się |
| 201 | Created | Zasób został utworzony |
| 400 | Bad Request | Błędne żądanie |
| 404 | Not Found | Zasób nie znaleziony |
| 422 | Unprocessable Entity | Błąd walidacji |
| 429 | Too Many Requests | Rate limit przekroczony |
| 500 | Internal Server Error | Błąd serwera |

---

## 7. Rate Limiting

- **Limit:** 10 żądań na godzinę per IP
- **Header:** `Retry-After` zawiera sekundy oczekiwania

```
HTTP/1.1 429 Too Many Requests
Retry-After: 3600
```

---

## 8. CORS (Cross-Origin Resource Sharing)

API akceptuje żądania z dowolnego origin (CORS enabled).

```
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET, POST, PUT, DELETE
Access-Control-Allow-Headers: Content-Type
```

---

## 9. Webhook Events (Future)

```
POST https://example.com/webhooks/contact-form
Content-Type: application/json

{
  "event": "contact.submitted",
  "data": {
    "id": 42,
    "imie": "Jan",
    "email": "jan@example.com",
    "timestamp": "2024-01-15T10:30:00Z"
  }
}
```

---

## 10. Testing API

### Postman Collection

```json
{
  "info": {
    "name": "Malarz Trzebnica API",
    "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
  },
  "item": [
    {
      "name": "Send Contact Form",
      "request": {
        "method": "POST",
        "url": "{{base_url}}/api/kontakt",
        "header": [
          {
            "key": "Content-Type",
            "value": "application/json"
          }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\"imie\":\"Jan\",\"email\":\"jan@example.com\",\"temat\":\"Test\",\"wiadomosc\":\"Test message\"}"
        }
      }
    }
  ]
}
```

### cURL Test Suite

```bash
#!/bin/bash

BASE_URL="https://www.malarz.trzebnica.pl/api"

echo "=== Testing Malarz Trzebnica API ==="

# Test 1: Pobierz kategorie
echo -e "\n1. GET /api/kategorie"
curl -s "$BASE_URL/kategorie" | jq .

# Test 2: Pobierz galerię
echo -e "\n2. GET /api/galeria"
curl -s "$BASE_URL/galeria" | jq .

# Test 3: Filtruj po kategorii
echo -e "\n3. GET /api/galeria?kategoria=malowanie-wnetrz"
curl -s "$BASE_URL/galeria?kategoria=malowanie-wnetrz" | jq .

# Test 4: Wyślij formularz
echo -e "\n4. POST /api/kontakt"
curl -X POST "$BASE_URL/kontakt" \
  -H "Content-Type: application/json" \
  -d '{
    "imie":"Jan Kowalski",
    "email":"jan@example.com",
    "temat":"Test",
    "wiadomosc":"Test message"
  }' | jq .
```

---

## 11. Monitoring API

**Endpoint:** `/health`

```bash
curl https://www.malarz.trzebnica.pl/health
```

Response:
```json
{
  "status": "healthy",
  "timestamp": "2024-01-15T10:30:00Z",
  "php_version": "8.1.0",
  "database": "connected"
}
```

---

## 12. API Documentation Tools

Wygeneruj dokumentację OpenAPI/Swagger:

```yaml
openapi: 3.0.0
info:
  title: Malarz Trzebnica API
  version: 1.0.0
servers:
  - url: https://www.malarz.trzebnica.pl/api

paths:
  /kontakt:
    post:
      summary: Wyślij wiadomość kontaktową
      tags:
        - Contact
      requestBody:
        required: true
        content:
          application/json:
            schema:
              $ref: '#/components/schemas/ContactMessage'
      responses:
        '201':
          description: Wiadomość wysłana
```

---

## 13. Changelog API

- **v1.0.0** (2024-01-15) - Inicjalna wersja API
- **v1.1.0** (Zaplanowane) - Admin endpoints
- **v2.0.0** (Zaplanowane) - Authentication, pagination

---

## Support

**Email:** kontakt@malarz.trzebnica.pl
**Telefon:** +48 452 690 824

---

**Ostatnia aktualizacja:** 2024-01-15

# Architektura MVC - Malarz Trzebnica

## 1. Wstęp

Projekt **Malarz Trzebnica** wykorzystuje wzorzec architektoniczny **Model-View-Controller (MVC)** do zapewnienia czystego kodu, łatwej konserwacji i rozszerzalności aplikacji. Dokument ten opisuje szczegółowo implementację MVC w naszym projekcie.

### Charakterystyka MVC w projekcie:
- **PHP 7.4+** jako język backendu
- **Bootstrap 5** dla warstwy prezentacji
- **Autoloading PSR-4** dla automatycznego ładowania klas
- **Routing** bez bibliotek frameworków (pure PHP)
- **Separacja concerns** - wyraźny podział odpowiedzialności

---

## 2. Struktura Katalogów

```
malarz-trzebnica-php/
├── public/
│   ├── index.php                 # Punkt wejścia aplikacji
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   └── images/
│   └── .htaccess                 # Reguły URL Rewrite
├── src/
│   ├── Controllers/              # Klasy kontrolerów
│   │   ├── HomeController.php
│   │   ├── GaleriaController.php
│   │   ├── OUslugachController.php
│   │   ├── KontaktController.php
│   │   └── AdminController.php
│   ├── Models/                   # Klasy modeli
│   │   ├── Database.php
│   │   ├── Projekt.php
│   │   ├── Zlecenie.php
│   │   ├── Wiadomosc.php
│   │   └── User.php
│   ├── Views/                    # Szablony HTML
│   │   ├── home.php
│   │   ├── galeria.php
│   │   ├── o-uslugach.php
│   │   ├── kontakt.php
│   │   ├── admin/
│   │   └── layouts/
│   │       ├── header.php
│   │       ├── footer.php
│   │       └── navigation.php
│   └── Core/                     # Klasy rdzenia frameworku
│       ├── Router.php
│       ├── Database.php
│       ├── Validator.php
│       └── Security.php
├── config/
│   ├── database.php              # Konfiguracja bazy danych
│   ├── app.php                   # Ustawienia aplikacji
│   └── routes.php                # Definicje routów
├── tests/
│   ├── Unit/
│   └── Feature/
├── storage/
│   ├── logs/                     # Logi aplikacji
│   ├── uploads/                  # Przesłane pliki
│   └── cache/                    # Cache aplikacji
├── composer.json                 # Zależności PHP
└── .htaccess                      # Główne reguły routowania
```

---

## 3. Autoloading PSR-4

### 3.1 Konfiguracja w composer.json

```json
{
  "require": {
    "php": "^7.4"
  },
  "require-dev": {
    "phpunit/phpunit": "^9.5"
  },
  "autoload": {
    "psr-4": {
      "App\\": "src/"
    }
  }
}
```

### 3.2 Jak to działa?

PSR-4 mapuje przestrzenie nazw bezpośrednio na katalogi:

- `App\Controllers\HomeController` → `src/Controllers/HomeController.php`
- `App\Models\Projekt` → `src/Models/Projekt.php`
- `App\Core\Router` → `src/Core/Router.php`

### 3.3 Automatyczne ładowanie w index.php

```php
<?php
// public/index.php

// Załaduj autoloader Composera
require_once dirname(__DIR__) . '/vendor/autoload.php';

// Teraz możemy używać klas bez require
use App\Core\Router;
use App\Core\Database;

// Inicjuj aplikację
$router = new Router();
$router->run();
```

### 3.4 Ręczne ładowanie (jeśli nie używasz Composera)

```php
<?php
// Prosty autoloader PSR-4
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    
    if (strpos($class, $prefix) !== 0) {
        return;
    }
    
    $relative_class = substr($class, strlen($prefix));
    $file = dirname(__DIR__) . '/src/' . str_replace('\\', '/', $relative_class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});
```

---

## 4. Routing

### 4.1 System Routingu

Router obsługuje wszystkie ścieżki aplikacji i kieruje żądania do odpowiednich kontrolerów.

**Plik: src/Core/Router.php**

```php
<?php
namespace App\Core;

class Router
{
    private $routes = [];
    private $currentUri;
    private $currentMethod;
    
    public function __construct()
    {
        $this->currentUri = $this->parseUri();
        $this->currentMethod = $_SERVER['REQUEST_METHOD'];
    }
    
    /**
     * Rejestruj trasę GET
     */
    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
        return $this;
    }
    
    /**
     * Rejestruj trasę POST
     */
    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
        return $this;
    }
    
    /**
     * Rejestruj trasę PUT
     */
    public function put($path, $callback)
    {
        $this->routes['PUT'][$path] = $callback;
        return $this;
    }
    
    /**
     * Rejestruj trasę DELETE
     */
    public function delete($path, $callback)
    {
        $this->routes['DELETE'][$path] = $callback;
        return $this;
    }
    
    /**
     * Uruchom router
     */
    public function run()
    {
        $routeFound = false;
        
        if (isset($this->routes[$this->currentMethod])) {
            foreach ($this->routes[$this->currentMethod] as $path => $callback) {
                if ($this->matchRoute($path, $this->currentUri)) {
                    $routeFound = true;
                    $this->callCallback($callback);
                    break;
                }
            }
        }
        
        if (!$routeFound) {
            http_response_code(404);
            echo "404 - Strona nie znaleziona";
        }
    }
    
    /**
     * Porównaj ścieżkę z parametrami dynamicznymi
     */
    private function matchRoute($path, $uri)
    {
        // Zamień parametry {id} na regex
        $pattern = preg_replace('/{([a-zA-Z_][a-zA-Z0-9_]*)}/', '(?P<$1>[^/]+)', $path);
        $pattern = '#^' . $pattern . '$#';
        
        if (preg_match($pattern, $uri, $matches)) {
            // Zapisz parametry do $_GET
            foreach ($matches as $key => $value) {
                if (!is_numeric($key)) {
                    $_GET[$key] = $value;
                }
            }
            return true;
        }
        
        return false;
    }
    
    /**
     * Wykonaj callback
     */
    private function callCallback($callback)
    {
        if (is_string($callback)) {
            // Format: "ControllerName@methodName"
            [$controller, $method] = explode('@', $callback);
            $controllerClass = 'App\\Controllers\\' . $controller;
            
            if (class_exists($controllerClass)) {
                $instance = new $controllerClass();
                if (method_exists($instance, $method)) {
                    $instance->$method();
                }
            }
        } elseif (is_callable($callback)) {
            call_user_func($callback);
        }
    }
    
    /**
     * Parsuj URI z globalnego $_SERVER
     */
    private function parseUri()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        
        // Usuń query string
        if (strpos($uri, '?') !== false) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        
        return $uri ?: '/';
    }
}
```

### 4.2 Definicja Routów

**Plik: config/routes.php**

```php
<?php

use App\Core\Router;

$router = new Router();

// Strony publiczne
$router->get('/', 'HomeController@index');
$router->get('/galeria', 'GaleriaController@index');
$router->get('/galeria/{kategoria}', 'GaleriaController@kategoria');
$router->get('/o-uslugach', 'OUslugachController@index');
$router->get('/o-uslugach/{usluga}', 'OUslugachController@szczegoly');
$router->get('/kontakt', 'KontaktController@formularz');
$router->post('/kontakt', 'KontaktController@wyslij');

// Panel administracyjny
$router->get('/admin', 'AdminController@dashboard');
$router->get('/admin/projekty', 'AdminController@projekty');
$router->post('/admin/projekty', 'AdminController@dodajProjekt');
$router->post('/admin/zdjecia/{id}', 'AdminController@dodajZdjecie');
$router->delete('/admin/zdjecia/{id}', 'AdminController@usunZdjecie');

// API
$router->post('/api/kontakt', 'ApiController@kontakt');
$router->get('/api/galeria', 'ApiController@galeria');

return $router;
```

### 4.3 Rewrite URLs (.htaccess)

**Plik: public/.htaccess**

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Określ katalog bazowy
    RewriteBase /
    
    # Jeśli plik lub katalog istnieje, nie przetwarzaj
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    
    # Przekieruj wszystko do index.php
    RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>
```

### 4.4 Punkt Wejścia (index.php)

**Plik: public/index.php**

```php
<?php

// Ustaw error reporting (podczas developmentu)
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__DIR__) . '/storage/logs/php_errors.log');

// Załaduj autoloader
require_once dirname(__DIR__) . '/vendor/autoload.php';

// Załaduj konfigurację
$config = require_once dirname(__DIR__) . '/config/app.php';
$database = require_once dirname(__DIR__) . '/config/database.php';

// Załaduj ruter
$router = require_once dirname(__DIR__) . '/config/routes.php';

// Uruchom router
$router->run();
```

---

## 5. Warstwa Model

### 5.1 Klasa Bazowa Database

**Plik: src/Core/Database.php**

```php
<?php
namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private $pdo;
    private $statement;
    
    public function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['database']};charset=utf8mb4";
        
        try {
            $this->pdo = new PDO(
                $dsn,
                $config['user'],
                $config['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            die('Błąd połączenia z bazą danych: ' . $e->getMessage());
        }
    }
    
    /**
     * Wykonaj query
     */
    public function query($sql, $params = [])
    {
        $this->statement = $this->pdo->prepare($sql);
        
        foreach ($params as $key => $value) {
            $this->statement->bindValue($key + 1, $value);
        }
        
        $this->statement->execute();
        return $this;
    }
    
    /**
     * Pobierz jeden wiersz
     */
    public function single()
    {
        return $this->statement->fetch();
    }
    
    /**
     * Pobierz wszystkie wiersze
     */
    public function getAll()
    {
        return $this->statement->fetchAll();
    }
    
    /**
     * Pobierz liczbę wierszy
     */
    public function rowCount()
    {
        return $this->statement->rowCount();
    }
}
```

### 5.2 Model - Przykład (Projekt)

**Plik: src/Models/Projekt.php**

```php
<?php
namespace App\Models;

use App\Core\Database;

class Projekt
{
    private $db;
    
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    
    /**
     * Pobierz wszystkie projekty
     */
    public function getAll()
    {
        $this->db->query('SELECT * FROM projekty ORDER BY data_utworzenia DESC');
        return $this->db->getAll();
    }
    
    /**
     * Pobierz projekt po ID
     */
    public function getById($id)
    {
        $this->db->query('SELECT * FROM projekty WHERE id = ?', [$id]);
        return $this->db->single();
    }
    
    /**
     * Pobierz projekty z kategorii
     */
    public function getByCategoria($kategoria)
    {
        $this->db->query(
            'SELECT * FROM projekty WHERE kategoria = ? ORDER BY data_utworzenia DESC',
            [$kategoria]
        );
        return $this->db->getAll();
    }
    
    /**
     * Utwórz nowy projekt
     */
    public function create($data)
    {
        $sql = 'INSERT INTO projekty (nazwa, opis, kategoria, przed, po, data_utworzenia) 
                VALUES (?, ?, ?, ?, ?, NOW())';
        
        $this->db->query($sql, [
            $data['nazwa'],
            $data['opis'],
            $data['kategoria'],
            $data['przed'],
            $data['po'],
        ]);
        
        return $this->db->rowCount() > 0;
    }
    
    /**
     * Aktualizuj projekt
     */
    public function update($id, $data)
    {
        $sql = 'UPDATE projekty SET nazwa = ?, opis = ?, kategoria = ? WHERE id = ?';
        
        $this->db->query($sql, [
            $data['nazwa'],
            $data['opis'],
            $data['kategoria'],
            $id,
        ]);
        
        return $this->db->rowCount() > 0;
    }
    
    /**
     * Usuń projekt
     */
    public function delete($id)
    {
        $this->db->query('DELETE FROM projekty WHERE id = ?', [$id]);
        return $this->db->rowCount() > 0;
    }
}
```

---

## 6. Warstwa Kontroler

### 6.1 Kontroler Bazowy

**Plik: src/Controllers/BaseController.php**

```php
<?php
namespace App\Controllers;

use App\Core\Database;

abstract class BaseController
{
    protected $db;
    
    public function __construct()
    {
        $config = require dirname(__DIR__, 2) . '/config/database.php';
        $this->db = new Database($config);
    }
    
    /**
     * Renderuj widok
     */
    protected function view($viewName, $data = [])
    {
        extract($data);
        
        $viewPath = dirname(__DIR__) . '/Views/' . $viewName . '.php';
        
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            die("Widok nie znaleziony: $viewName");
        }
    }
    
    /**
     * Renderuj z layoutem
     */
    protected function render($viewName, $data = [])
    {
        ob_start();
        $this->view($viewName, $data);
        $content = ob_get_clean();
        
        // Renderuj layout
        extract(['content' => $content]);
        require dirname(__DIR__) . '/Views/layouts/main.php';
    }
    
    /**
     * Wyślij JSON
     */
    protected function json($data, $statusCode = 200)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
    
    /**
     * Przekieruj
     */
    protected function redirect($path)
    {
        header("Location: $path");
        exit;
    }
}
```

### 6.2 Konkretny Kontroler - Galeria

**Plik: src/Controllers/GaleriaController.php**

```php
<?php
namespace App\Controllers;

use App\Models\Projekt;

class GaleriaController extends BaseController
{
    /**
     * Wyświetl galerię ze wszystkimi projektami
     */
    public function index()
    {
        $projektModel = new Projekt($this->db);
        $projekty = $projektModel->getAll();
        
        // Pobierz kategorie
        $kategorie = array_unique(array_column($projekty, 'kategoria'));
        
        $this->render('galeria', [
            'projekty' => $projekty,
            'kategorie' => $kategorie,
            'title' => 'Galeria - Malarz Trzebnica',
            'description' => 'Galeria realizacji prac malarskich i wykończeniowych'
        ]);
    }
    
    /**
     * Wyświetl projekty z konkretnej kategorii
     */
    public function kategoria()
    {
        $kategoria = $_GET['kategoria'] ?? 'wszystkie';
        
        $projektModel = new Projekt($this->db);
        
        if ($kategoria === 'wszystkie') {
            $projekty = $projektModel->getAll();
        } else {
            $projekty = $projektModel->getByCategoria($kategoria);
        }
        
        if (count($projekty) === 0) {
            http_response_code(404);
            echo "Brak projektów w kategorii: $kategoria";
            return;
        }
        
        $this->render('galeria', [
            'projekty' => $projekty,
            'kategoria' => $kategoria,
            'title' => 'Galeria - ' . ucfirst($kategoria),
        ]);
    }
}
```

---

## 7. Warstwa View

### 7.1 Layout Główny

**Plik: src/Views/layouts/main.php**

```php
<?php
$title = $title ?? 'Malarz Trzebnica';
$description = $description ?? 'Profesjonalne usługi malarskie';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($description); ?>">
    <title><?php echo htmlspecialchars($title); ?></title>
    
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <?php require __DIR__ . '/header.php'; ?>
    
    <main role="main">
        <?php echo $content; ?>
    </main>
    
    <?php require __DIR__ . '/footer.php'; ?>
    
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/app.js"></script>
</body>
</html>
```

### 7.2 Widok - Galeria

**Plik: src/Views/galeria.php**

```php
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1>Galeria Naszych Prac</h1>
            <p class="lead">Realizacje malarskie i wykończeniowe</p>
        </div>
    </div>
    
    <!-- Filtry kategorii -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="btn-group" role="group">
                <a href="/galeria" class="btn btn-outline-primary">Wszystkie</a>
                <?php foreach ($kategorie as $kat): ?>
                    <a href="/galeria/<?php echo urlencode($kat); ?>" class="btn btn-outline-primary">
                        <?php echo htmlspecialchars($kat); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <!-- Galeria -->
    <div class="row g-4">
        <?php foreach ($projekty as $projekt): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <img src="/assets/images/<?php echo htmlspecialchars($projekt['przed']); ?>" 
                         class="card-img-top" alt="Przed">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($projekt['nazwa']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($projekt['opis']); ?></p>
                        <small class="text-muted"><?php echo htmlspecialchars($projekt['kategoria']); ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
```

---

## 8. Przepływ Danych

```
┌─────────────────────────────────────────────────────────────┐
│                     UŻYTKOWNIK                              │
└────────────────────────┬────────────────────────────────────┘
                         │ HTTP Request
                         ▼
        ┌─────────────────────────────────────┐
        │        public/index.php              │
        │     (Punkt Wejścia Aplikacji)        │
        └────────────────┬────────────────────┘
                         │
         ┌───────────────▼──────────────────┐
         │   Załaduj Autoloader (PSR-4)     │
         │   Załaduj Konfigurację           │
         └───────────────┬──────────────────┘
                         │
         ┌───────────────▼──────────────────┐
         │      src/Core/Router.php          │
         │   (Analiza Request URI)           │
         └───────────────┬──────────────────┘
                         │
    ┌────────────────────▼────────────────────┐
    │   Dopasowanie Trasy (Route Matching)   │
    │  Wyodrębnianie parametrów dynamicznych │
    └────────────────────┬────────────────────┘
                         │
    ┌────────────────────▼────────────────────┐
    │      Instancjowanie Kontrolera          │
    │     Wywołanie odpowiedniej metody       │
    └────────────────────┬────────────────────┘
                         │
    ┌────────────────────▼────────────────────┐
    │     src/Controllers/*.php               │
    │      (Logika Aplikacji)                 │
    │  - Walidacja danych                     │
    │  - Komunikacja z modelem                │
    │  - Przygotowanie danych do widoku       │
    └────────────────────┬────────────────────┘
                         │
    ┌────────────────────▼────────────────────┐
    │      src/Models/*.php                   │
    │      (Logika Biznesowa)                 │
    │  - Zapytania SQL                        │
    │  - Transformacja danych                 │
    │  - Walidacja reguł biznesowych          │
    └────────────────────┬────────────────────┘
                         │
    ┌────────────────────▼────────────────────┐
    │      src/Core/Database.php              │
    │       (Dostęp do Bazy Danych)           │
    │   - Przygotowane zapytania              │
    │   - Ochrona przed SQL Injection         │
    └────────────────────┬────────────────────┘
                         │
                   [DATABASE]
                         │
    ┌────────────────────▼────────────────────┐
    │        Zwrot Wyników                    │
    │   (Dane z bazy do modelu)               │
    └────────────────────┬────────────────────┘
                         │
    ┌────────────────────▼────────────────────┐
    │    Zwrot do Kontrolera                  │
    │   (Sformatowane dane)                   │
    └────────────────────┬────────────────────┘
                         │
    ┌────────────────────▼────────────────────┐
    │   Renderowanie Widoku                   │
    │     src/Views/*.php                     │
    │   - HTML + CSS + JavaScript             │
    │   - Wstawianie danych do szablonu       │
    └────────────────────┬────────────────────┘
                         │
    ┌────────────────────▼────────────────────┐
    │   Zawinięcie w Layout                   │
    │   src/Views/layouts/main.php            │
    │   - Header                              │
    │   - Content (zawartość widoku)          │
    │   - Footer                              │
    └────────────────────┬────────────────────┘
                         │
                         │ HTTP Response
                         ▼
    ┌──────────────────────────────────────────┐
    │           PRZEGLĄDARKA                   │
    │      (Render HTML strony)                │
    └──────────────────────────────────────────┘
```

---

## 9. Przykład Kompletnego Cyklu Żądania

### Szenariusz: Użytkownik wchodzi na `/galeria/malowanie-wnetrz`

#### 1. Router analizuje żądanie
```php
// Analiza URI: /galeria/malowanie-wnetrz
// Metoda: GET
// Dopasowanie do trasy: /galeria/{kategoria}
// Parametr kategoria = "malowanie-wnetrz"
```

#### 2. Router wywoła kontroler
```php
$router->get('/galeria/{kategoria}', 'GaleriaController@kategoria');
// Wywoła: GaleriaController->kategoria()
```

#### 3. Kontroler pobiera dane
```php
public function kategoria()
{
    $kategoria = $_GET['kategoria']; // = "malowanie-wnetrz"
    
    $projektModel = new Projekt($this->db);
    $projekty = $projektModel->getByCategoria($kategoria);
    
    $this->render('galeria', ['projekty' => $projekty]);
}
```

#### 4. Model wykonuje zapytanie
```php
public function getByCategoria($kategoria)
{
    // Prepared statement - bezpieczne przed SQL Injection
    $this->db->query(
        'SELECT * FROM projekty WHERE kategoria = ? ORDER BY data_utworzenia DESC',
        [$kategoria]
    );
    return $this->db->getAll();
}
```

#### 5. Database wykonuje bezpieczne zapytanie
```php
public function query($sql, $params = [])
{
    // Przygotowanie zapytania
    $this->statement = $this->pdo->prepare($sql);
    
    // Bindowanie parametrów (bezpieczeństwo)
    foreach ($params as $key => $value) {
        $this->statement->bindValue($key + 1, $value);
    }
    
    // Wykonanie
    $this->statement->execute();
}
```

#### 6. Widok renderuje dane
```php
<?php foreach ($projekty as $projekt): ?>
    <div class="card">
        <h5><?php echo htmlspecialchars($projekt['nazwa']); ?></h5>
        <p><?php echo htmlspecialchars($projekt['opis']); ?></p>
    </div>
<?php endforeach; ?>
```

#### 7. Layout zawija widok
```html
<!DOCTYPE html>
<html>
<head>...</head>
<body>
    <header>...</header>
    <main>
        <!-- Tutaj renderowany widok galeria.php -->
    </main>
    <footer>...</footer>
</body>
</html>
```

#### 8. HTML wysyłany do przeglądarki
```
HTTP/1.1 200 OK
Content-Type: text/html; charset=UTF-8

<!DOCTYPE html>
<html>
...
(kompletna strona HTML)
...
</html>
```

---

## 10. Best Practices w MVC

### 10.1 Separacja Odpowiedzialności
- **Model**: Tylko logika biznesowa i dostęp do danych
- **Controller**: Tylko logika aplikacji i kierowanie przepływem
- **View**: Tylko prezentacja danych

### 10.2 DRY (Don't Repeat Yourself)
```php
// ❌ ZŁE - powtarzanie kodu
public function getAll() {
    $db = new Database();
    return $db->query('SELECT * FROM projekty')->getAll();
}

// ✅ DOBRE - wspólna klasa bazowa
class BaseController {
    protected $db;
    // Database zainicjalizowany w konstruktorze
}
```

### 10.3 Bezpieczeństwo Parametrów
```php
// ❌ ZŁE - podatne na SQL Injection
$sql = "SELECT * FROM projekty WHERE id = " . $_GET['id'];

// ✅ DOBRE - prepared statements
$db->query('SELECT * FROM projekty WHERE id = ?', [$id]);
```

### 10.4 Walidacja i Filtracja
```php
// ✅ DOBRE - zawsze waliduj dane
$validator = new Validator();
$validator->required('email');
$validator->email('email');
$validator->minLength('haslo', 8);

if (!$validator->validate($_POST)) {
    $errors = $validator->getErrors();
}
```

### 10.5 Obsługa Błędów
```php
// ✅ DOBRE - logowanie błędów
try {
    $model->delete($id);
} catch (Exception $e) {
    error_log('Błąd usuwania projektu: ' . $e->getMessage());
    http_response_code(500);
    $this->json(['error' => 'Błąd serwera'], 500);
}
```

---

## 11. Testy Jednostkowe

**Plik: tests/Unit/Models/ProjektTest.php**

```php
<?php
namespace Tests\Unit\Models;

use App\Models\Projekt;
use App\Core\Database;
use PHPUnit\Framework\TestCase;

class ProjektTest extends TestCase
{
    private $db;
    private $projekt;
    
    protected function setUp(): void
    {
        // Mock database
        $this->db = $this->createMock(Database::class);
        $this->projekt = new Projekt($this->db);
    }
    
    public function testGetAll()
    {
        $mockData = [
            ['id' => 1, 'nazwa' => 'Projekt 1'],
            ['id' => 2, 'nazwa' => 'Projekt 2'],
        ];
        
        $this->db->expects($this->once())
            ->method('query')
            ->willReturnSelf();
        
        $this->db->expects($this->once())
            ->method('getAll')
            ->willReturn($mockData);
        
        $result = $this->projekt->getAll();
        $this->assertCount(2, $result);
    }
}
```

---

## Podsumowanie

Architektura MVC w projekcie **Malarz Trzebnica** zapewnia:

✅ Czysty, czytelny kod
✅ Łatwą konserwację i rozszerzalność
✅ Separację odpowiedzialności
✅ Bezpieczeństwo (SQL Injection, XSS)
✅ Testowność kodu
✅ Skalowność aplikacji

Każdy layer (Model, View, Controller) ma jasno zdefiniowaną rolę i nie powinna się ze sobą mieszać ich logika.

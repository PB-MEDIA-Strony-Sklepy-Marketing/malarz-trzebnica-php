# Dokumentacja Galerii GLightbox - Malarz Trzebnica

## 1. Wstęp

Dokumentacja implementacji responsywnej galerii zdjęć z **GLightbox** - lekkiej biblioteki lightbox'a bez zależności jQuery. Zawiera instrukcje instalacji, konfiguracji i zarządzania galerią projektów malarskich.

**Glavne cechy:**
- Lekka (8KB minified)
- Brak zależności zewnętrznych
- Obsługa touchscreen'u
- Animacje CSS
- Responsywna na wszystkich urządzeniach
- SEO friendly

---

## 2. Instalacja i Konfiguracja

### 2.1 Pobranie GLightbox

#### Opcja 1: CDN (Najprościej)

```html
<!-- W pliku src/Views/layouts/main.php -->
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mcstudios/glightbox@latest/dist/glightbox.min.css">
</head>

<body>
    <!-- ... zawartość ... -->
    
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox@latest/dist/glightbox.min.js"></script>
    <script>
        const lightbox = GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
        });
    </script>
</body>
```

#### Opcja 2: NPM (Dla profesjonalnych projektów)

```bash
cd /path/to/malarz-trzebnica-php
npm install glightbox
```

Potem w pliku `src/Views/layouts/main.php`:

```php
<head>
    <link rel="stylesheet" href="/node_modules/glightbox/dist/glightbox.min.css">
</head>

<script src="/node_modules/glightbox/dist/glightbox.min.js"></script>
<script>
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
    });
</script>
```

#### Opcja 3: Pobierz Ręcznie

```
1. Przejdź na https://github.com/mcstudios/glightbox
2. Pobierz najnowszą wersję (dist/glightbox.min.js i .css)
3. Wrzuć do public/assets/vendor/glightbox/
4. Dołącz pliki do layoutu
```

### 2.2 Struktura Katalogów dla Galerii

```
malarz-trzebnica-php/
├── public/
│   ├── assets/
│   │   ├── images/
│   │   │   ├── galeria/
│   │   │   │   ├── malowanie-wnetrz/
│   │   │   │   │   ├── projekt-1-thumb.jpg
│   │   │   │   │   ├── projekt-1-full.jpg
│   │   │   │   │   ├── projekt-2-thumb.jpg
│   │   │   │   │   └── projekt-2-full.jpg
│   │   │   │   ├── szpachlowanie/
│   │   │   │   ├── glazura/
│   │   │   │   ├── podlogi/
│   │   │   │   └── elewacje/
│   │   │   └── avatars/
│   │   ├── css/
│   │   │   ├── glightbox.min.css
│   │   │   └── galeria.css
│   │   ├── js/
│   │   │   ├── glightbox.min.js
│   │   │   └── galeria.js
│   │   └── vendor/
│   │       └── glightbox/
│   └── uploads/
│       └── galeria/
├── storage/
│   ├── temp/           # Tymczasowe pliki
│   ├── cache/
│   │   └── galeria/    # Cache miniatur
│   └── logs/
└── src/
    ├── Models/
    │   ├── Projekt.php
    │   └── Zdjecie.php
    ├── Controllers/
    │   └── GaleriaController.php
    └── Views/
        └── galeria.php
```

---

## 3. Model Danych

### 3.1 Struktura Bazy Danych

```sql
-- Tabela projektów
CREATE TABLE projekty (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nazwa VARCHAR(255) NOT NULL,
    opis TEXT,
    kategoria VARCHAR(100),
    przed VARCHAR(255),
    po VARCHAR(255),
    data_utworzenia TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    aktywny TINYINT(1) DEFAULT 1,
    INDEX idx_kategoria (kategoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela zdjęć (galeria)
CREATE TABLE zdjecia (
    id INT PRIMARY KEY AUTO_INCREMENT,
    projekt_id INT NOT NULL,
    sciezka_plik VARCHAR(255) NOT NULL,
    miniatura VARCHAR(255),
    alt_text VARCHAR(255),
    tytul VARCHAR(255),
    opis TEXT,
    kolejnosc INT DEFAULT 0,
    data_dodania TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (projekt_id) REFERENCES projekty(id) ON DELETE CASCADE,
    INDEX idx_projekt_id (projekt_id),
    INDEX idx_kolejnosc (kolejnosc)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela kategorii
CREATE TABLE kategorie (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nazwa VARCHAR(100) UNIQUE NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    opis TEXT,
    ikona VARCHAR(50),
    kolejnosc INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Wypełnij kategorie
INSERT INTO kategorie (nazwa, slug, opis, ikona) VALUES
('Malowanie Wnętrz', 'malowanie-wnetrz', 'Profesjonalne malowanie pomieszczeń mieszkalnych', 'paint-brush'),
('Szpachlowanie', 'szpachlowanie', 'Wyrównywanie i szpachlowanie ścian', 'wrench'),
('Gładź Gipsowa', 'gk', 'Montaż i wykończenie gładzi gipsowych', 'wall'),
('Podłogi', 'podlogi', 'Przygotowanie i pokrywanie podłóg', 'tile'),
('Glazura', 'glazura', 'Kładzenie glazury w łazienkach i kuchniach', 'tiles'),
('Elewacje', 'elewacje', 'Prace malarskie na elewacjach budynków', 'building');
```

### 3.2 Model Zdjęcia

**Plik: src/Models/Zdjecie.php**

```php
<?php
namespace App\Models;

use App\Core\Database;

class Zdjecie
{
    private $db;
    
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    
    /**
     * Pobierz wszystkie zdjęcia projektu
     */
    public function getByProjekt($projektId)
    {
        $this->db->query(
            'SELECT * FROM zdjecia WHERE projekt_id = ? ORDER BY kolejnosc ASC',
            [$projektId]
        );
        return $this->db->getAll();
    }
    
    /**
     * Pobierz zdjęcie po ID
     */
    public function getById($id)
    {
        $this->db->query('SELECT * FROM zdjecia WHERE id = ?', [$id]);
        return $this->db->single();
    }
    
    /**
     * Pobierz wszystkie zdjęcia z kategorii
     */
    public function getByKategoria($kategoria)
    {
        $this->db->query(
            'SELECT z.* FROM zdjecia z
             INNER JOIN projekty p ON z.projekt_id = p.id
             WHERE p.kategoria = ?
             ORDER BY p.data_utworzenia DESC, z.kolejnosc ASC',
            [$kategoria]
        );
        return $this->db->getAll();
    }
    
    /**
     * Utwórz nowe zdjęcie
     */
    public function create($data)
    {
        $sql = 'INSERT INTO zdjecia (projekt_id, sciezka_plik, miniatura, alt_text, tytul, opis, kolejnosc)
                VALUES (?, ?, ?, ?, ?, ?, ?)';
        
        $this->db->query($sql, [
            $data['projekt_id'],
            $data['sciezka_plik'],
            $data['miniatura'],
            $data['alt_text'],
            $data['tytul'],
            $data['opis'],
            $data['kolejnosc'] ?? 0,
        ]);
        
        return $this->db->rowCount() > 0;
    }
    
    /**
     * Aktualizuj zdjęcie
     */
    public function update($id, $data)
    {
        $sql = 'UPDATE zdjecia SET alt_text = ?, tytul = ?, opis = ?, kolejnosc = ? WHERE id = ?';
        
        $this->db->query($sql, [
            $data['alt_text'],
            $data['tytul'],
            $data['opis'],
            $data['kolejnosc'],
            $id,
        ]);
        
        return $this->db->rowCount() > 0;
    }
    
    /**
     * Usuń zdjęcie
     */
    public function delete($id)
    {
        $zdjecie = $this->getById($id);
        
        if ($zdjecie) {
            // Usuń plik z dysku
            $fullPath = dirname(__DIR__, 2) . '/public' . $zdjecie['sciezka_plik'];
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
            
            // Usuń miniaturę
            $thumbPath = dirname(__DIR__, 2) . '/public' . $zdjecie['miniatura'];
            if (file_exists($thumbPath)) {
                unlink($thumbPath);
            }
            
            // Usuń z bazy danych
            $this->db->query('DELETE FROM zdjecia WHERE id = ?', [$id]);
            return $this->db->rowCount() > 0;
        }
        
        return false;
    }
}
```

### 3.3 Model Projekt (rozszerzony)

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
     * Pobierz projekt z zdjęciami
     */
    public function getWithZdjecia($id)
    {
        $this->db->query('SELECT * FROM projekty WHERE id = ?', [$id]);
        $projekt = $this->db->single();
        
        if ($projekt) {
            $zdjecia = new Zdjecie($this->db);
            $projekt['zdjecia'] = $zdjecia->getByProjekt($id);
        }
        
        return $projekt;
    }
    
    /**
     * Pobierz wszystkie projekty z liczbą zdjęć
     */
    public function getAllWithCount()
    {
        $this->db->query(
            'SELECT p.*, COUNT(z.id) as liczba_zdj FROM projekty p
             LEFT JOIN zdjecia z ON p.id = z.projekt_id
             WHERE p.aktywny = 1
             GROUP BY p.id
             ORDER BY p.data_utworzenia DESC'
        );
        return $this->db->getAll();
    }
    
    /**
     * Pobierz projekty z konkretnej kategorii z zdjęciami
     */
    public function getByKategoriaWithZdjecia($kategoria)
    {
        $this->db->query(
            'SELECT p.* FROM projekty p
             WHERE p.kategoria = ? AND p.aktywny = 1
             ORDER BY p.data_utworzenia DESC',
            [$kategoria]
        );
        $projekty = $this->db->getAll();
        
        // Dodaj zdjęcia do każdego projektu
        $zdjeciaModel = new Zdjecie($this->db);
        foreach ($projekty as &$projekt) {
            $projekt['zdjecia'] = $zdjeciaModel->getByProjekt($projekt['id']);
        }
        
        return $projekty;
    }
}
```

---

## 4. Kontroler Galerii

**Plik: src/Controllers/GaleriaController.php**

```php
<?php
namespace App\Controllers;

use App\Models\Projekt;
use App\Models\Zdjecie;

class GaleriaController extends BaseController
{
    /**
     * Wyświetl główną galerię
     */
    public function index()
    {
        $projektModel = new Projekt($this->db);
        $projekty = $projektModel->getAllWithCount();
        
        // Pobierz kategorie z bazy
        $this->db->query('SELECT * FROM kategorie ORDER BY kolejnosc ASC');
        $kategorie = $this->db->getAll();
        
        $this->render('galeria', [
            'projekty' => $projekty,
            'kategorie' => $kategorie,
            'title' => 'Galeria - Malarz Trzebnica',
            'description' => 'Galeria realizacji prac malarskich, szpachlowania i wykończeniowych',
            'keywords' => 'malarz Trzebnica, galeria, realizacje, malowanie wnętrz'
        ]);
    }
    
    /**
     * Wyświetl galerię z wybraną kategorią
     */
    public function kategoria()
    {
        $kategoria = $_GET['kategoria'] ?? null;
        
        if (!$kategoria) {
            $this->redirect('/galeria');
        }
        
        $projektModel = new Projekt($this->db);
        $projekty = $projektModel->getByKategoriaWithZdjecia($kategoria);
        
        if (count($projekty) === 0) {
            http_response_code(404);
            $this->render('404', ['message' => 'Brak projektów w tej kategorii']);
            return;
        }
        
        // Pobierz kategorię
        $this->db->query('SELECT * FROM kategorie WHERE slug = ?', [$kategoria]);
        $kategoriaInfo = $this->db->single();
        
        $this->render('galeria', [
            'projekty' => $projekty,
            'kategoria' => $kategoria,
            'kategoriaInfo' => $kategoriaInfo,
            'title' => 'Galeria - ' . ($kategoriaInfo['nazwa'] ?? $kategoria),
            'description' => $kategoriaInfo['opis'] ?? '',
        ]);
    }
    
    /**
     * Wyświetl szczegóły projektu
     */
    public function szczegoly()
    {
        $projektId = $_GET['id'] ?? null;
        
        if (!$projektId) {
            $this->redirect('/galeria');
        }
        
        $projektModel = new Projekt($this->db);
        $projekt = $projektModel->getWithZdjecia($projektId);
        
        if (!$projekt) {
            http_response_code(404);
            $this->render('404', ['message' => 'Projekt nie znaleziony']);
            return;
        }
        
        $this->render('projekt-szczegoly', [
            'projekt' => $projekt,
            'title' => 'Projekt: ' . $projekt['nazwa'],
            'description' => $projekt['opis'],
        ]);
    }
}
```

---

## 5. Widok Galerii

**Plik: src/Views/galeria.php**

```php
<div class="container-fluid py-5" id="galeria-section">
    <div class="container">
        <!-- Header -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Galeria Naszych Prac</h1>
                <p class="lead text-muted mb-4">
                    Realizacje malarskie i wykończeniowe z naszej wieloletniej działalności
                </p>
            </div>
        </div>
        
        <!-- Filtry kategorii -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    <a href="/galeria" class="btn btn-outline-primary <?php echo !isset($kategoria) ? 'active' : ''; ?>">
                        Wszystkie Projekty
                    </a>
                    
                    <?php foreach ($kategorie as $kat): ?>
                        <a href="/galeria?kategoria=<?php echo urlencode($kat['slug']); ?>" 
                           class="btn btn-outline-primary <?php echo ($kategoria ?? null) === $kat['slug'] ? 'active' : ''; ?>">
                            <?php echo htmlspecialchars($kat['nazwa']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <!-- Galeria projektów -->
        <div class="row g-4" id="galeria-grid">
            <?php foreach ($projekty as $projekt): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 galeria-card position-relative overflow-hidden">
                        <!-- Miniatura -->
                        <div class="galeria-image-wrapper position-relative" style="height: 250px;">
                            <?php if (!empty($projekt['zdjecia']) && count($projekt['zdjecia']) > 0): ?>
                                <img src="<?php echo htmlspecialchars($projekt['zdjecia'][0]['miniatura']); ?>" 
                                     class="card-img-top h-100 object-fit-cover" 
                                     alt="<?php echo htmlspecialchars($projekt['zdjecia'][0]['alt_text'] ?? $projekt['nazwa']); ?>">
                            <?php else: ?>
                                <div class="card-img-top h-100 bg-light d-flex align-items-center justify-content-center">
                                    <span class="text-muted">Brak zdjęcia</span>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Overlay z przyciskami -->
                            <div class="galeria-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center gap-3">
                                <!-- Przycisk otworzenia galerii -->
                                <?php if (!empty($projekt['zdjecia']) && count($projekt['zdjecia']) > 0): ?>
                                    <a href="#" class="btn btn-light btn-sm galeria-open" 
                                       data-projekt-id="<?php echo $projekt['id']; ?>" 
                                       data-toggle="glightbox">
                                        <i class="bi bi-images"></i> 
                                        <?php echo count($projekt['zdjecia']); ?> zdjęć
                                    </a>
                                <?php endif; ?>
                                
                                <!-- Przycisk szczegółów -->
                                <a href="/galeria/projekt?id=<?php echo $projekt['id']; ?>" class="btn btn-light btn-sm">
                                    <i class="bi bi-eye"></i> Szczegóły
                                </a>
                            </div>
                        </div>
                        
                        <!-- Informacje o projekcie -->
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($projekt['nazwa']); ?></h5>
                            <p class="card-text text-muted"><?php echo htmlspecialchars(substr($projekt['opis'], 0, 100)) . '...'; ?></p>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="badge bg-primary">
                                    <?php echo htmlspecialchars($projekt['kategoria']); ?>
                                </small>
                                <small class="text-muted">
                                    <?php echo $projekt['liczba_zdj'] ?? 0; ?> zdjęć
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Brak projektów -->
        <?php if (count($projekty) === 0): ?>
            <div class="alert alert-info text-center mt-5" role="alert">
                <h4>Brak projektów</h4>
                <p>Wkrótce dodamy nowe realizacje w tej kategorii.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Galeria lightbox (ukryta, dla GLightbox) -->
<div id="glightbox-gallery" style="display: none;">
    <?php foreach ($projekty as $projekt): ?>
        <?php foreach ($projekt['zdjecia'] as $zdjecie): ?>
            <a href="<?php echo htmlspecialchars($zdjecie['sciezka_plik']); ?>" 
               class="glightbox" 
               data-gallery="<?php echo 'galeria-' . $projekt['id']; ?>"
               data-project-id="<?php echo $projekt['id']; ?>"
               title="<?php echo htmlspecialchars($zdjecie['tytul'] ?? ''); ?>"
               data-description="<?php echo htmlspecialchars($zdjecie['opis'] ?? ''); ?>">
            </a>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>

<!-- CSS dla galerii -->
<style>
    .galeria-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .galeria-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }
    
    .galeria-image-wrapper {
        overflow: hidden;
        background: #f5f5f5;
    }
    
    .galeria-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .galeria-card:hover .galeria-image-wrapper img {
        transform: scale(1.05);
    }
    
    .galeria-overlay {
        background: rgba(0, 0, 0, 0.7);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 10;
    }
    
    .galeria-card:hover .galeria-overlay {
        opacity: 1;
    }
    
    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.85rem;
    }
</style>

<!-- JavaScript dla galerii -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicjalizuj GLightbox
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        autoplayVideos: false,
        plyr: {
            css: 'https://cdn.plyr.io/3.6.12/plyr.css',
            js: 'https://cdn.plyr.io/3.6.12/plyr.js',
            config: {
                ratio: '16:9',
                autoplay: false,
                controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'settings', 'pip', 'airplay', 'download', 'fullscreen']
            }
        }
    });
    
    // Obsługa kliknięcia na przycisk galerii
    document.querySelectorAll('.galeria-open').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const projektId = this.dataset.projektId;
            
            // Filtruj i wyświetl zdjęcia danego projektu
            const firstPhoto = document.querySelector(
                `a.glightbox[data-gallery="galeria-${projektId}"]`
            );
            
            if (firstPhoto) {
                lightbox.openAt(
                    Array.from(document.querySelectorAll('a.glightbox')).indexOf(firstPhoto)
                );
            }
        });
    });
});
</script>
```

---

## 6. Optymalizacja Zdjęć

### 6.1 Klasa do Konwersji i Kompresji Zdjęć

**Plik: src/Core/ImageOptimizer.php**

```php
<?php
namespace App\Core;

class ImageOptimizer
{
    private $maxWidth = 1920;
    private $maxHeight = 1440;
    private $thumbWidth = 400;
    private $thumbHeight = 300;
    private $quality = 85;
    
    /**
     * Optymalizuj i utwórz miniaturę
     */
    public function process($sourcePath, $destinationDir, $filename)
    {
        if (!file_exists($sourcePath)) {
            throw new \Exception('Plik źródłowy nie istnieje');
        }
        
        // Sprawdź typ pliku
        $mimeType = mime_content_type($sourcePath);
        if (!in_array($mimeType, ['image/jpeg', 'image/png', 'image/webp'])) {
            throw new \Exception('Nieobsługiwany typ pliku');
        }
        
        // Utwórz katalog jeśli nie istnieje
        if (!is_dir($destinationDir)) {
            mkdir($destinationDir, 0755, true);
        }
        
        // Załaduj obraz
        $image = match($mimeType) {
            'image/jpeg' => imagecreatefromjpeg($sourcePath),
            'image/png' => imagecreatefrompng($sourcePath),
            'image/webp' => imagecreatefromwebp($sourcePath),
        };
        
        if (!$image) {
            throw new \Exception('Nie można załadować obrazu');
        }
        
        // Pobierz wymiary
        $width = imagesx($image);
        $height = imagesy($image);
        
        // Zmień rozmiar głównego obrazu
        $newDimensions = $this->calculateDimensions($width, $height, $this->maxWidth, $this->maxHeight);
        $resized = $this->resizeImage($image, $newDimensions['width'], $newDimensions['height']);
        
        // Zapisz główny obraz
        $mainPath = $destinationDir . '/' . $filename . '.jpg';
        imagejpeg($resized, $mainPath, $this->quality);
        imagedestroy($resized);
        
        // Utwórz i zapisz miniaturę
        $thumbDimensions = $this->calculateDimensions($width, $height, $this->thumbWidth, $this->thumbHeight);
        $thumb = $this->resizeImage($image, $thumbDimensions['width'], $thumbDimensions['height']);
        
        $thumbPath = $destinationDir . '/' . $filename . '-thumb.jpg';
        imagejpeg($thumb, $thumbPath, $this->quality);
        imagedestroy($thumb);
        
        imagedestroy($image);
        
        return [
            'main' => str_replace(dirname(__DIR__, 2) . '/public', '', $mainPath),
            'thumb' => str_replace(dirname(__DIR__, 2) . '/public', '', $thumbPath),
        ];
    }
    
    /**
     * Oblicz nowe wymiary zachowując aspekt ratio
     */
    private function calculateDimensions($width, $height, $maxWidth, $maxHeight)
    {
        $aspectRatio = $width / $height;
        
        if ($width > $maxWidth || $height > $maxHeight) {
            if ($width / $maxWidth > $height / $maxHeight) {
                $newWidth = $maxWidth;
                $newHeight = intval($maxWidth / $aspectRatio);
            } else {
                $newHeight = $maxHeight;
                $newWidth = intval($maxHeight * $aspectRatio);
            }
        } else {
            $newWidth = $width;
            $newHeight = $height;
        }
        
        return ['width' => $newWidth, 'height' => $newHeight];
    }
    
    /**
     * Zmień rozmiar obrazu
     */
    private function resizeImage($image, $width, $height)
    {
        $resized = imagecreatetruecolor($width, $height);
        imagecopyresampled($resized, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
        return $resized;
    }
}
```

### 6.2 Kontroler do Obsługi Uploadów (Admin)

**Plik: src/Controllers/AdminController.php (fragment)**

```php
<?php
namespace App\Controllers;

use App\Core\ImageOptimizer;
use App\Models\Zdjecie;

class AdminController extends BaseController
{
    /**
     * Dodaj zdjęcie do projektu
     */
    public function dodajZdjecie()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            $this->json(['error' => 'Metoda nie dozwolona'], 405);
        }
        
        $projektId = $_GET['id'] ?? null;
        
        if (!$projektId) {
            $this->json(['error' => 'Brakuje ID projektu'], 400);
        }
        
        // Sprawdź czy plik został przesłany
        if (!isset($_FILES['zdjecie']) || $_FILES['zdjecie']['error'] !== UPLOAD_ERR_OK) {
            $this->json(['error' => 'Błąd przy przesyłaniu pliku'], 400);
        }
        
        $file = $_FILES['zdjecie'];
        $uploadDir = dirname(__DIR__, 2) . '/public/assets/images/galeria/';
        
        try {
            // Optymalizuj obraz
            $optimizer = new ImageOptimizer();
            $filename = uniqid() . '_' . preg_replace('/[^a-z0-9.-]/i', '_', $file['name']);
            
            $paths = $optimizer->process($file['tmp_name'], $uploadDir, pathinfo($filename, PATHINFO_FILENAME));
            
            // Zapisz do bazy danych
            $zdjecieModel = new Zdjecie($this->db);
            $success = $zdjecieModel->create([
                'projekt_id' => $projektId,
                'sciezka_plik' => '/assets/images/galeria/' . pathinfo($filename, PATHINFO_FILENAME) . '.jpg',
                'miniatura' => '/assets/images/galeria/' . pathinfo($filename, PATHINFO_FILENAME) . '-thumb.jpg',
                'alt_text' => $_POST['alt_text'] ?? '',
                'tytul' => $_POST['tytul'] ?? '',
                'opis' => $_POST['opis'] ?? '',
                'kolejnosc' => $_POST['kolejnosc'] ?? 0,
            ]);
            
            if ($success) {
                $this->json(['success' => true, 'message' => 'Zdjęcie dodane pomyślnie']);
            } else {
                $this->json(['error' => 'Błąd przy zapisywaniu do bazy'], 500);
            }
        } catch (\Exception $e) {
            $this->json(['error' => $e->getMessage()], 500);
        }
    }
    
    /**
     * Usuń zdjęcie
     */
    public function usunZdjecie()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            http_response_code(405);
            $this->json(['error' => 'Metoda nie dozwolona'], 405);
        }
        
        $zdjecieId = $_GET['id'] ?? null;
        
        if (!$zdjecieId) {
            $this->json(['error' => 'Brakuje ID zdjęcia'], 400);
        }
        
        $zdjecieModel = new Zdjecie($this->db);
        
        if ($zdjecieModel->delete($zdjecieId)) {
            $this->json(['success' => true, 'message' => 'Zdjęcie usunięte']);
        } else {
            $this->json(['error' => 'Nie można usunąć zdjęcia'], 500);
        }
    }
}
```

---

## 7. Konfiguracja CSS

**Plik: public/assets/css/galeria.css**

```css
/* Galeria - Style dodatowe */

.galeria-section {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 5rem 0;
}

.galeria-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.galeria-card {
    border-radius: 0.5rem;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    cursor: pointer;
}

.galeria-card:hover {
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
}

.galeria-image-wrapper {
    position: relative;
    width: 100%;
    padding-bottom: 75%; /* 4:3 aspect ratio */
    overflow: hidden;
    background: #f0f0f0;
}

.galeria-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.galeria-card:hover .galeria-image {
    transform: scale(1.1);
}

.galeria-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    gap: 1rem;
}

.galeria-card:hover .galeria-overlay {
    opacity: 1;
}

/* Responsywność */
@media (max-width: 768px) {
    .galeria-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }
    
    .galeria-section {
        padding: 3rem 0;
    }
}

@media (max-width: 480px) {
    .galeria-grid {
        grid-template-columns: 1fr;
    }
}

/* GLightbox customization */
.glightbox-container {
    background: rgba(0, 0, 0, 0.95);
    z-index: 10000;
}

.glightbox-slide {
    animation: slideInImage 0.3s ease-in-out;
}

@keyframes slideInImage {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Licznik zdjęć */
.glightbox-counter {
    color: white;
    font-size: 0.9rem;
}

.glightbox-desc {
    color: rgba(255, 255, 255, 0.8);
    margin-top: 1rem;
    font-size: 0.95rem;
}
```

---

## 8. Best Practices

### 8.1 Dodawanie Nowych Zdjęć
1. Przygotuj zdjęcia w wysokiej rozdzielczości (min. 1920x1440px)
2. Zmień nazwę na opisową (np. `projekt-malowanie-salon-01.jpg`)
3. Użyj panelu admina do uploadowania
4. Poczekaj na optymalizację (zmianę rozmiaru i kompresję)
5. Dodaj alt text i opis dla SEO

### 8.2 Formatowanie Zdjęć
- Format: **JPG** (dla fotografii), **PNG** (dla grafiki z przezroczystością)
- Rozmiar: 1920x1440px (dla głównego widoku)
- Rozmiar miniatury: 400x300px (będzie tworzona automatycznie)
- Jakość: 85% (domyślnie, można zmienić)

### 8.3 Optymalizacja dla SEO
```html
<img src="/assets/images/galeria/projekt-thumb.jpg"
     alt="Malowanie salonu domowego - Trzebnica"
     title="Projekt: Profesjonalne malowanie wnętrz">
```

### 8.4 Lazy Loading (dla wydajności)
```html
<img src="/assets/images/galeria/projekt-thumb.jpg"
     loading="lazy"
     alt="Projekt malarski">
```

---

## 9. Troubleshooting

| Problem | Rozwiązanie |
|---------|------------|
| GLightbox nie otwiera się | Sprawdź czy biblioteka załadowana w layoutzie |
| Zdjęcia ładują się powoli | Zmniejsz rozmiar/użyj optymalizatora |
| Miniatury się nie tworzą | Sprawdź uprawnienia katalogów (755) |
| Błąd CORS w galerii | Sprawdź konfigurację nginx/Apache headers |
| Zdjęcia na mobilach rozmyte | Dodaj `srcset` dla responsive images |

---

## 10. Wskaźniki Wydajności

Dobrze skonfigurowana galeria powinny mieć:
- **LCP** (Largest Contentful Paint): < 2.5s
- **CLS** (Cumulative Layout Shift): < 0.1
- **Rozmiar zdjęcia**: 100-300KB (dla pełnego rozmiaru)
- **Rozmiar miniatury**: 20-50KB

---

## Podsumowanie

Galeria GLightbox zapewnia:
✅ Lekka i szybka
✅ Bez zależności jQuery
✅ Responsywna design
✅ SEO friendly
✅ Łatwa w zarządzaniu
✅ Automatyczna optymalizacja zdjęć

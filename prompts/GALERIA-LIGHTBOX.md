# Prompt: Implementacja Galerii z Lightbox - Malarz Trzebnica

## Zadanie

Zaimplementuj galerię zdjęć portfolio z lightbox dla strony Malarz Trzebnica.

## Wymagania Funkcjonalne

### Biblioteka Lightbox

Użyj **GLightbox** (zalecane) lub **Lightbox2**:

```html
<!-- GLightbox CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
```

### Struktura Galerii

```html
<div class="gallery-grid">
  <?php foreach ($images as $image): ?>
    <a href="<?= $image['full'] ?>" 
       class="glightbox" 
       data-gallery="portfolio"
       data-title="<?= $image['title'] ?>"
       data-description="<?= $image['description'] ?>">
      <img src="<?= $image['thumb'] ?>" 
           alt="<?= $image['alt'] ?>"
           loading="lazy"
           class="gallery-image">
    </a>
  <?php endforeach; ?>
</div>
```

### Grid Layout (CSS)

```css
.gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 20px;
  padding: 20px;
}

.gallery-image {
  width: 100%;
  height: 300px;
  object-fit: cover;
  border-radius: 8px;
  transition: transform 0.3s ease;
}

.gallery-image:hover {
  transform: scale(1.05);
}

/* Responsive */
@media (max-width: 768px) {
  .gallery-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 480px) {
  .gallery-grid {
    grid-template-columns: 1fr;
  }
}
```

### Inicjalizacja JavaScript

```javascript
// Initialize GLightbox
document.addEventListener('DOMContentLoaded', () => {
  const lightbox = GLightbox({
    touchNavigation: true,
    loop: true,
    autoplayVideos: true,
    closeButton: true,
    zoomable: true,
    draggable: true,
  });
});
```

## Filtrowanie Kategorii

```html
<div class="gallery-filters">
  <button class="filter-btn active" data-filter="all">Wszystkie</button>
  <button class="filter-btn" data-filter="interior">Wnętrza</button>
  <button class="filter-btn" data-filter="exterior">Elewacje</button>
  <button class="filter-btn" data-filter="gk">Sucha zabudowa GK</button>
  <button class="filter-btn" data-filter="floors">Podłogi</button>
</div>

<script>
// Filter functionality
document.querySelectorAll('.filter-btn').forEach(btn => {
  btn.addEventListener('click', (e) => {
    const filter = e.target.dataset.filter;
    
    // Update active button
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    e.target.classList.add('active');
    
    // Filter images
    document.querySelectorAll('.gallery-grid a').forEach(item => {
      if (filter === 'all' || item.dataset.category === filter) {
        item.style.display = 'block';
      } else {
        item.style.display = 'none';
      }
    });
  });
});
</script>
```

## Optymalizacja Obrazów

### PHP Image Processing

```php
<?php
/**
 * Generuje miniaturki dla galerii
 */
function generateThumbnail(string $source, string $dest, int $width = 400, int $height = 300): bool
{
    $imageInfo = getimagesize($source);
    $mime = $imageInfo['mime'];
    
    // Tworzenie obrazu źródłowego
    switch ($mime) {
        case 'image/jpeg':
            $srcImage = imagecreatefromjpeg($source);
            break;
        case 'image/png':
            $srcImage = imagecreatefrompng($source);
            break;
        case 'image/webp':
            $srcImage = imagecreatefromwebp($source);
            break;
        default:
            return false;
    }
    
    // Obliczanie proporcji
    $srcWidth = imagesx($srcImage);
    $srcHeight = imagesy($srcImage);
    
    // Tworzenie miniatury
    $thumb = imagecreatetruecolor($width, $height);
    imagecopyresampled($thumb, $srcImage, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight);
    
    // Zapisywanie
    imagejpeg($thumb, $dest, 85);
    
    // Czyszczenie pamięci
    imagedestroy($srcImage);
    imagedestroy($thumb);
    
    return true;
}
```

### Lazy Loading

```html
<img src="placeholder.jpg" 
     data-src="<?= $image['thumb'] ?>" 
     alt="<?= $image['alt'] ?>"
     class="lazy"
     loading="lazy">

<script>
// Intersection Observer for lazy loading
const lazyImages = document.querySelectorAll('img.lazy');
const imageObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const img = entry.target;
      img.src = img.dataset.src;
      img.classList.remove('lazy');
      imageObserver.unobserve(img);
    }
  });
});

lazyImages.forEach(img => imageObserver.observe(img));
</script>
```

## SEO dla Galerii

### Alt Texts

```php
// Automatyczne generowanie alt texts
$alt = sprintf(
    '%s - %s - Malarz Trzebnica',
    $image['category'],
    $image['title']
);
// Przykład: "Malowanie wnętrz - Salon w kolorze beżowym - Malarz Trzebnica"
```

### Schema.org ImageGallery

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ImageGallery",
  "name": "Portfolio Malarz Trzebnica",
  "description": "Galeria zrealizowanych projektów",
  "image": [
    <?php foreach ($images as $index => $image): ?>
    {
      "@type": "ImageObject",
      "contentUrl": "<?= $image['full'] ?>",
      "thumbnail": "<?= $image['thumb'] ?>",
      "name": "<?= $image['title'] ?>",
      "description": "<?= $image['description'] ?>"
    }<?= $index < count($images) - 1 ? ',' : '' ?>
    <?php endforeach; ?>
  ]
}
</script>
```

## Kontroler Galerii

```php
<?php
namespace App\Controllers;

class GalleryController extends Controller
{
    public function index(): void
    {
        $images = $this->getGalleryImages();
        
        $data = [
            'title' => 'Galeria Realizacji - Malarz Trzebnica',
            'description' => 'Zobacz nasze zrealizowane projekty malarskie',
            'images' => $images,
            'categories' => $this->getCategories(),
        ];
        
        $this->render('pages/gallery', $data);
    }
    
    private function getGalleryImages(): array
    {
        // Pobierz z bazy lub plików
        $images = [];
        $directory = __DIR__ . '/../../uploads/gallery/';
        
        foreach (glob($directory . '*.{jpg,jpeg,png,webp}', GLOB_BRACE) as $file) {
            $filename = basename($file);
            $images[] = [
                'full' => '/uploads/gallery/' . $filename,
                'thumb' => '/uploads/gallery/thumbs/' . $filename,
                'title' => $this->getTitleFromFilename($filename),
                'alt' => $this->getAltFromFilename($filename),
                'category' => $this->getCategoryFromFilename($filename),
            ];
        }
        
        return $images;
    }
}
```

## Akcje

1. Zainstaluj GLightbox via CDN lub npm
2. Utwórz strukturę katalogów dla obrazów:
   - `dist/uploads/gallery/` - pełne rozmiary
   - `dist/uploads/gallery/thumbs/` - miniatury
3. Zaimplementuj kontroler `GalleryController`
4. Utwórz widok `views/pages/gallery.php`
5. Dodaj CSS dla grid layout
6. Przetestuj lightbox na urządzeniach mobilnych
7. Zoptymalizuj obrazy (WebP format)
8. Dodaj alt texts i Schema.org markup

---
**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm

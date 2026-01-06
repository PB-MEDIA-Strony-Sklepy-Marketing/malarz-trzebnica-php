# Prompt: Konwersja HTML na PHP MVC

Przekonwertuj statyczne pliki HTML na architekturę PHP MVC.

## Wymagania

1. **Struktura MVC**
   - Controllers w `dist/app/Controllers/`
   - Views w `dist/app/Views/`
   - Models w `dist/app/Models/` (jeśli potrzebne)

2. **PSR-4 Autoloading**
   - Namespace: `App\Controllers`, `App\Models`, `App\Services`

3. **Routing**
   - `/` → HomeController::index()
   - `/oferta` → OfferController::index()
   - `/galeria` → GalleryController::index()
   - `/kontakt` → ContactController::index()

4. **Komponenty**
   - Header, footer jako partials
   - Layout system dla DRY

---
**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm

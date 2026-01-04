# Ollama - Lokalne Modele AI dla Projektu Malarz Trzebnica

> Instrukcje konfiguracji i uzycia lokalnych modeli LLM przez Ollama

---

## Wprowadzenie

Ollama umozliwia uruchamianie duzych modeli jezykowych (LLM) lokalnie na Twoim komputerze. Jest to przydatne gdy:
- Pracujesz offline bez dostepu do internetu
- Potrzebujesz szybkich odpowiedzi bez latencji sieciowej
- Chcesz zachowac prywatnosc kodu (dane nie opuszczaja komputera)
- Chcesz uniknac kosztow API

---

## Instalacja Ollama

### Windows
```powershell
# Pobierz instalator z https://ollama.ai/download
# Lub przez winget:
winget install Ollama.Ollama
```

### Linux/macOS
```bash
curl -fsSL https://ollama.ai/install.sh | sh
```

### Weryfikacja instalacji
```bash
ollama --version
# ollama version 0.1.x
```

---

## Rekomendowane Modele dla Projektu

### 1. CodeLlama (7B/13B) - Generowanie Kodu
```bash
# Instalacja
ollama pull codellama:7b
ollama pull codellama:13b  # Wymaga 16GB RAM

# Uzycie
ollama run codellama:7b
```

**Zastosowanie w projekcie:**
- Generowanie kontrolerow PHP
- Tworzenie funkcji walidacji
- Pisanie zapytan SQL
- Refaktoryzacja kodu

### 2. Llama 2 (7B/13B) - Ogolne Zadania
```bash
ollama pull llama2:7b
ollama pull llama2:13b

ollama run llama2:7b
```

**Zastosowanie:**
- Pisanie dokumentacji
- Generowanie tresci po polsku
- Odpowiadanie na pytania o architekturze

### 3. Mistral (7B) - Szybki i Wydajny
```bash
ollama pull mistral:7b

ollama run mistral:7b
```

**Zastosowanie:**
- Szybkie uzupelnianie kodu
- Proste refaktoryzacje
- Generowanie komentarzy

### 4. DeepSeek Coder (6.7B) - Specjalista Kodu
```bash
ollama pull deepseek-coder:6.7b

ollama run deepseek-coder:6.7b
```

**Zastosowanie:**
- Zaawansowane generowanie PHP
- Analiza kodu
- Debugging

---

## Konfiguracja dla Projektu

### Utworz Modelfile dla Malarz Trzebnica
```bash
# Stworz plik: malarz-trzebnica.Modelfile
cat > malarz-trzebnica.Modelfile << 'MODELFILE'
FROM codellama:7b

PARAMETER temperature 0.7
PARAMETER top_p 0.9
PARAMETER num_ctx 4096

SYSTEM """
Jestes ekspertem PHP specjalizujacym sie w architekturze MVC.
Pracujesz nad projektem strony internetowej dla firmy malarskiej.

Kontekst projektu:
- Nazwa: Malarz Trzebnica
- Strona: www.malarz.trzebnica.pl
- Telefon: +48 452 690 824
- Stack: PHP 7.4+, Bootstrap 5, jQuery
- Architektura: MVC w katalogu dist/

Struktura katalogow:
- dist/index.php, oferta.php, galeria.php, kontakt.php
- dist/includes/header.php, footer.php, config.php
- dist/app/Controllers/, Models/, Services/, Helpers/
- dist/assets/css/, js/, images/

Zasady:
1. Uzywaj PSR-12 coding standard
2. Zawsze escapuj dane: htmlspecialchars()
3. Waliduj dane wejsciowe
4. Implementuj tokeny CSRF
5. Pisz kod po angielsku, komentarze moga byc po polsku
"""
MODELFILE

# Zbuduj model
ollama create malarz-php -f malarz-trzebnica.Modelfile
```

### Uruchom Skonfigurowany Model
```bash
ollama run malarz-php
```

---

## Przyklady Uzycia

### 1. Generowanie Kontrolera PHP
```
>>> Stworz ContactController.php z metoda submit() do obslugi formularza kontaktowego.
    Wymagania: walidacja email, telefon, CSRF token, zwrot JSON.
```

### 2. Tworzenie Modelu
```
>>> Napisz klase Service w namespace App\Models z polami:
    name (string), description (string), icon (string), price (float).
    Dodaj konstruktor i metode toArray().
```

### 3. Funkcja Walidacji
```
>>> Napisz funkcje validateContactForm($data) ktora sprawdza:
    - imie: niepuste, min 2 znaki
    - email: poprawny format
    - telefon: format polski (+48 lub 9 cyfr)
    - wiadomosc: niepusta, min 10 znakow
    Zwroc tablice bledow lub pusta tablice.
```

### 4. Optymalizacja SEO
```
>>> Napisz funkcje PHP generateMetaTags($page) ktora zwraca
    meta tagi title, description, keywords, og:* dla podstron:
    home, oferta, galeria, kontakt.
```

### 5. Komponent Bootstrap
```
>>> Stworz komponent PHP serviceCard($service) ktory generuje
    karte Bootstrap 5 z ikona Font Awesome, tytulem i opisem.
    Uzyj klas: card, card-body, shadow-sm.
```

---

## Integracja z IDE

### VS Code + Continue Extension
```json
// .continue/config.json
{
  "models": [
    {
      "title": "Malarz PHP",
      "provider": "ollama",
      "model": "malarz-php",
      "apiBase": "http://localhost:11434"
    }
  ]
}
```

### Cursor IDE
```json
// settings.json
{
  "ollama.endpoint": "http://localhost:11434",
  "ollama.model": "malarz-php"
}
```

---

## API Endpoint

Ollama udostepnia REST API na porcie 11434:

### Generowanie odpowiedzi
```bash
curl http://localhost:11434/api/generate -d '{
  "model": "malarz-php",
  "prompt": "Napisz funkcje PHP do walidacji emaila",
  "stream": false
}'
```

### Lista modeli
```bash
curl http://localhost:11434/api/tags
```

---

## Wymagania Sprzetowe

| Model | RAM | VRAM (GPU) | Dysk |
|-------|-----|------------|------|
| CodeLlama 7B | 8GB | 6GB | 4GB |
| CodeLlama 13B | 16GB | 10GB | 8GB |
| Llama2 7B | 8GB | 6GB | 4GB |
| Mistral 7B | 8GB | 6GB | 4GB |
| DeepSeek 6.7B | 8GB | 5GB | 4GB |

---

## Porownanie z API Cloud

| Aspekt | Ollama (lokalne) | Claude/GPT API |
|--------|------------------|----------------|
| Latencja | Niska (lokalna) | Wysza (sieciowa) |
| Prywatnosc | Pelna | Dane wysylane |
| Koszt | Jednorazowy (sprzet) | Za token |
| Jakosc | Dobra (7B-13B) | Najlepsza |
| Offline | Tak | Nie |

---

## Wskazowki

1. **Zacznij od mniejszych modeli** (7B) i zwieksz jesli potrzeba
2. **Uzywaj GPU** dla szybszego generowania (NVIDIA CUDA)
3. **Dostosuj temperature** - nizs  za (0.3-0.5) dla kodu, wyzsza (0.7-0.9) dla tresci
4. **Zapisuj dobre prompty** w plikach do ponownego uzycia
5. **Lacz z IDE** dla najlepszego doswiadczenia

---

## Rozwiazywanie Problemow

### Model nie laduje sie
```bash
# Sprawdz logi
ollama logs

# Zrestartuj serwis
ollama serve
```

### Za wolne generowanie
```bash
# Uzyj mniejszego modelu
ollama run codellama:7b-instruct

# Lub zmniejsz kontekst
PARAMETER num_ctx 2048
```

### Brak pamieci
```bash
# Zwolnij pamiec
ollama stop malarz-php

# Uzyj modelu 7B zamiast 13B
```

---

**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm

*Ollama instrukcje - Styczen 2025*

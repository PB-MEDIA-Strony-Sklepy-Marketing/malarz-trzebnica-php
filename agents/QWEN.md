# Qwen - Modele Alibaba Cloud dla Projektu Malarz Trzebnica

> Instrukcje uzycia modeli Qwen (Alibaba Cloud) do pracy z projektem PHP

---

## Wprowadzenie

Qwen (Tongyi Qianwen) to rodzina duzych modeli jezykowych od Alibaba Cloud. Oferuja:
- Swietne wsparcie dla jezykow azjatyckich i europejskich
- Modele zoptymalizowane pod kod (Qwen-Coder)
- Dostep przez API Alibaba Cloud lub lokalnie przez Ollama
- Konkurencyjne ceny w porownaniu z OpenAI/Anthropic

---

## Dostepne Modele Qwen

### Qwen 2.5 (Najnowsza generacja)
| Model | Parametry | Zastosowanie |
|-------|-----------|--------------|
| qwen2.5:0.5b | 0.5B | Ultraszybkie, proste zadania |
| qwen2.5:1.5b | 1.5B | Lekkie, szybkie odpowiedzi |
| qwen2.5:3b | 3B | Balans szybkosci i jakosci |
| qwen2.5:7b | 7B | Zaawansowane zadania |
| qwen2.5:14b | 14B | Profesjonalna jakosc |
| qwen2.5:32b | 32B | Najwyzsza jakosc |
| qwen2.5:72b | 72B | Maksymalna wydajnosc |

### Qwen Coder (Specjalizacja kodowanie)
| Model | Zastosowanie |
|-------|--------------|
| qwen2.5-coder:1.5b | Szybkie uzupelnianie kodu |
| qwen2.5-coder:7b | Generowanie PHP, JavaScript |
| qwen2.5-coder:14b | Zaawansowane programowanie |
| qwen2.5-coder:32b | Architektura, refaktoryzacja |

---

## Instalacja przez Ollama

```bash
# Zainstaluj model Qwen Coder (rekomendowany dla projektu)
ollama pull qwen2.5-coder:7b

# Lub standardowy Qwen
ollama pull qwen2.5:7b

# Uruchom
ollama run qwen2.5-coder:7b
```

---

## Konfiguracja dla Projektu

### Modelfile dla Malarz Trzebnica
```dockerfile
# malarz-qwen.Modelfile
FROM qwen2.5-coder:7b

PARAMETER temperature 0.6
PARAMETER top_p 0.9
PARAMETER num_ctx 8192

SYSTEM """
You are an expert PHP developer specializing in MVC architecture.
You are working on a website for a professional painting company.

Project Context:
- Company: Malarz Trzebnica (Painting Company)
- Website: www.malarz.trzebnica.pl
- Phone: +48 452 690 824
- Location: Trzebnica, Poland
- Tech Stack: PHP 7.4+, Bootstrap 5, jQuery, GSAP
- Architecture: MVC in dist/ directory

Key Directories:
- dist/index.php, oferta.php, galeria.php, kontakt.php
- dist/includes/header.php, footer.php, config.php
- dist/app/Controllers/, Models/, Services/, Helpers/
- dist/assets/css/, js/, images/

Coding Standards:
1. Follow PSR-12 coding standard
2. Always escape output: htmlspecialchars()
3. Validate all input data
4. Implement CSRF tokens for forms
5. Use type hints in PHP 7.4+
6. Write code in English, comments can be in Polish

Services offered by the company (for content):
- Interior painting (malowanie wnetrz)
- Exterior painting (malowanie elewacji)
- Wall plastering (szpachlowanie scian)
- Drywall installation (sucha zabudowa GK)
- Floor installation (ukladanie podlog)
- Tiling (glazura)
"""
```

```bash
# Zbuduj model
ollama create malarz-qwen -f malarz-qwen.Modelfile

# Uruchom
ollama run malarz-qwen
```

---

## Przyklady Promptow

### Polski (Native)
```
>>> Napisz kontroler PHP GalleryController z metodami:
    - index() - lista wszystkich realizacji
    - show($id) - pojedyncza realizacja
    - category($slug) - filtrowanie po kategorii
    Uzyj architektury MVC, waliduj parametry, zwroc JSON lub HTML.
```

### English
```
>>> Create a PHP ContactService class that:
    - Validates contact form data (name, email, phone, message)
    - Sends email using PHPMailer
    - Logs contact attempts
    - Returns success/error response
    Follow PSR-12 standards.
```

### Mieszany (Mixed)
```
>>> Generate meta tags function for SEO.
    Pages: strona glowna (home), oferta (services), galeria (gallery), kontakt (contact).
    Include: title, description, og:* tags.
    Keywords: malarz Trzebnica, uslugi malarskie, firma malarska.
```

---

## Porownanie z Innymi Modelami

| Aspekt | Qwen 2.5 | Claude | GPT-4 | Llama |
|--------|----------|--------|-------|-------|
| Polski | Dobry | Swietny | Swietny | Sredni |
| Kodowanie | Swietny | Swietny | Swietny | Dobry |
| Szybkosc | Szybki | Sredni | Sredni | Szybki |
| Koszt API | Niski | Sredni | Wysoki | Darmowy |
| Lokalnie | Tak (Ollama) | Nie | Nie | Tak |

---

## API Alibaba Cloud (Opcjonalne)

### Rejestracja
1. Utworz konto na https://www.alibabacloud.com
2. Aktywuj Tongyi Qianwen API
3. Wygeneruj API key

### Uzycie API
```python
# Python example
from dashscope import Generation

response = Generation.call(
    model='qwen-turbo',
    prompt='Napisz funkcje PHP do walidacji formularza kontaktowego',
    api_key='your-api-key'
)
print(response.output.text)
```

```bash
# cURL
curl -X POST https://dashscope.aliyuncs.com/api/v1/services/aigc/text-generation/generation \
  -H "Authorization: Bearer $API_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "model": "qwen-turbo",
    "input": {
      "prompt": "Create PHP validation function"
    }
  }'
```

---

## Zastosowania w Projekcie

### 1. Generowanie Kodu PHP
```
Qwen-Coder jest szczegolnie dobry w:
- Tworzeniu klas i interfejsow
- Pisaniu funkcji walidacji
- Generowaniu kontrolerow MVC
- Refaktoryzacji kodu
```

### 2. Tresci SEO
```
Qwen dobrze radzi sobie z:
- Meta descriptions po polsku
- Tresciami na strone
- Schema.org markup
- Alt tekstami dla obrazow
```

### 3. Dokumentacja
```
Uzyj do:
- Komentarzy PHPDoc
- README i instrukcji
- Opisow funkcji
- Changelog
```

---

## Wskazowki dla Polskiego Jezyka

1. **Uzyj kontekstu** - podaj ze pracujesz nad polska strona
2. **Mieszaj jezyki** - kod po angielsku, tresci po polsku
3. **Specyfikuj znaki** - wspomnij o polskich znakach (ą, ę, ó, etc.)
4. **Testuj output** - sprawdz poprawnosc gramatyczna

### Przyklad z Polskim Kontekstem
```
>>> Wygeneruj tresci na strone oferta.php dla firmy malarskiej.
    Sekcje: naglowek, lista uslug z opisami, CTA.
    Styl: profesjonalny, przyjazny, lokalny.
    Slowa kluczowe: malarz Trzebnica, uslugi malarskie, remonty.
    Uzyj poprawnej polszczyzny z akcentami.
```

---

## Wydajnosc i Limity

### Lokalne (Ollama)
| Model | RAM | Szybkosc | Jakosc |
|-------|-----|----------|--------|
| qwen2.5:3b | 4GB | Bardzo szybki | Podstawowa |
| qwen2.5-coder:7b | 8GB | Szybki | Dobra |
| qwen2.5:14b | 16GB | Sredni | Wysoka |
| qwen2.5:32b | 32GB | Wolny | Bardzo wysoka |

### API Cloud
- Rate limits: 60 RPM (requests per minute)
- Token limit: 8K-32K w zaleznosci od modelu
- Koszt: ~$0.0008/1K tokenow (qwen-turbo)

---

## Rozwiazywanie Problemow

### Problemy z Polskimi Znakami
```
# Upewnij sie ze uzywasz UTF-8
PARAMETER charset utf-8

# W prompcie:
"Uzyj polskich znakow diakrytycznych: ą, ć, ę, ł, ń, ó, ś, ź, ż"
```

### Model Nie Rozumie Kontekstu
```
# Dodaj wiecej kontekstu w SYSTEM prompt
# Lub uzywaj few-shot examples
```

### Wolne Odpowiedzi
```
# Uzyj mniejszego modelu
ollama run qwen2.5-coder:1.5b

# Lub zmniejsz num_ctx
PARAMETER num_ctx 4096
```

---

**Malarz Trzebnica** - Precyzja, Perfekcja, Profesjonalizm

*Qwen instrukcje - Styczen 2025*

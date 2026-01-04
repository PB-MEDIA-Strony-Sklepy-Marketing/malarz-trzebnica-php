# Rola

Jesteś ekspertem w tworzeniu stron internetowych specjalizującym się w Bootstrap, PHP oraz konwersji projektów HTML. Posiadasz dogłębną wiedzę na temat struktury projektów webowych, najlepszych praktyk SEO dla lokalnych firm usługowych oraz umiejętność tworzenia responsywnych, profesjonalnych stron internetowych dla małych i średnich przedsiębiorstw.

# Zadanie

Przekonwertuj szablon bazowy HTML Bootstrap (zlokalizowany w `src/index.html`) na kompletną, w pełni funkcjonalną stronę internetową w PHP dla firmy malarskiej. Strona musi zawierać cztery podstrony: Strona Główna, Oferta, Galeria i Kontakt. Projekt końcowy musi być gotowy do wdrożenia produkcyjnego pod adresem www.malarz.trzebnica.pl.

# Kontekst

Tworzysz stronę dla profesjonalnej firmy malarskiej działającej w Trzebnicy, której slogan to "Precision, Perfection, Professional". Firma specjalizuje się w usługach wykończeniowych ze szczególnym naciskiem na usługi malarskie wewnątrz i na zewnątrz pomieszczeń, szpachlowanie ścian oraz suchą zabudowę GK. Dodatkowe usługi obejmują układanie podłóg (panele podłogowe i wykładziny), układanie glazury na podłogach i ścianach oraz drobne elementy wykończenia wnętrz. Firma dysponuje profesjonalnym i nowoczesnym sprzętem.

Dane kontaktowe firmy:

- Strona www: www.malarz.trzebnica.pl
- Telefon: +48 452 690 824

Struktura projektu w repozytorium GitHub:

- Motyw bazowy: `src/` (szablon Bootstrap znajduje się w `src/index.html`)
- Agenci: `agents/`
- Motyw docelowy końcowy PHP: `dist/`
- Dokumentacja: `docs/`
- Prompty: `prompts/`
- Teksty page content: `text/`
- Baza wiedzy: `knowledge/`
- Instrukcje: `instructions/`

# Instrukcje

Asystent powinien wykonać następujące kroki w podanej kolejności:

1. **Analiza szablonu bazowego**: Przeanalizuj istniejący szablon HTML Bootstrap w pliku `src/index.html` aby zrozumieć jego strukturę, komponenty, style i układ. Zidentyfikuj wszystkie sekcje, komponenty Bootstrap i zasoby (CSS, JS, obrazy), które będą wymagały adaptacji w strukturze PHP.

2. **Konwersja na modułową strukturę PHP**: Przekonwertuj szablon HTML na modułową strukturę PHP z następującymi elementami:
   
   - Stwórz plik `dist/includes/header.php` zawierający sekcję `<head>`, nawigację i wszystkie globalne elementy górnej części strony
   - Stwórz plik `dist/includes/footer.php` zawierający stopkę z danymi kontaktowymi i zamykające tagi HTML
   - Utwórz osobne pliki PHP dla każdej podstrony w katalogu głównym `dist/`: `index.php` (Strona Główna), `oferta.php` (Oferta), `galeria.php` (Galeria), `kontakt.php` (Kontakt)
   - Każdy plik podstrony powinien używać `include` lub `require` do wczytania header.php i footer.php
   - Zaimplementuj system ścieżek względnych dostosowany do struktury PHP, zapewniając poprawne działanie nawigacji między stronami
   - Upewnij się, że wszystkie linki wewnętrzne wskazują na pliki .php zamiast .html

3. **Implementacja treści**: Wykorzystaj zawartość z katalogu `text/` oraz informacje z bazy wiedzy `knowledge/` do wypełnienia każdej podstrony:
   
   - **Strona Główna** (`index.php`): Prezentacja firmy ze sloganem "Precision, Perfection, Professional" jako główny element hero section, krótki opis usług z podkreśleniem profesjonalizmu, call-to-action z danymi kontaktowymi (telefon +48 452 690 824), sekcja "O nas" przedstawiająca doświadczenie i nowoczesny sprzęt
   - **Oferta** (`oferta.php`): Szczegółowy opis wszystkich usług podzielony na sekcje z wykorzystaniem kart Bootstrap lub accordionów:
     * Usługi malarskie (wewnątrz i na zewnątrz pomieszczeń) - główna specjalizacja
     * Szpachlowanie ścian
     * Sucha zabudowa GK
     * Układanie podłóg (panele podłogowe i wykładziny)
     * Układanie glazury na podłogach i ścianach
     * Drobne elementy wykończenia wnętrz
     * Podkreślenie posiadania profesjonalnego i nowoczesnego sprzętu
   - **Galeria** (`galeria.php`): Zaimplementuj responsywną galerię Bootstrap (grid system lub carousel) przygotowaną do prezentacji trzech kategorii zdjęć:
     * Wnętrza mieszkalne (malowanie pokoi, szpachlowanie)
     * Elewacje budynków (prace zewnętrzne)
     * Detale wykończeniowe (precyzja wykonania, close-upy)
     * Struktura powinna być gotowa do łatwego dodawania zdjęć przez klienta
   - **Kontakt** (`kontakt.php`): Formularz kontaktowy z polami (imię, email, telefon, wiadomość), wyraźnie wyeksponowane dane firmy (www.malarz.trzebnica.pl, telefon +48 452 690 824), opcjonalnie osadzona mapa Google Maps z lokalizacją Trzebnica

4. **Optymalizacja dla produkcji**: Przygotuj kod do wdrożenia produkcyjnego:
   
   - Zoptymalizuj kod PHP pod kątem wydajności (minimalizacja zapytań, efektywne includes)
   - Upewnij się, że wszystkie ścieżki do zasobów (CSS, JS, obrazy) są poprawne i używają ścieżek względnych
   - Zaimplementuj podstawowe zabezpieczenia dla formularza kontaktowego:
     * Walidacja danych po stronie serwera (PHP)
     * Ochrona przed XSS (htmlspecialchars)
     * Ochrona przed CSRF (token)
     * Podstawowa ochrona przed spam (honeypot lub captcha)
   - Dodaj meta tagi SEO dla lokalnego biznesu:
     * Title i description dla każdej podstrony
     * Open Graph tags
     * Schema.org markup dla LocalBusiness
     * Słowa kluczowe: malarz Trzebnica, usługi malarskie, wykończenia wnętrz
   - Zapewnij pełną responsywność wykorzystując klasy Bootstrap na wszystkich urządzeniach (mobile-first approach)

5. **Struktura katalogów**: Umieść wszystkie pliki produkcyjne w katalogu `dist/` zgodnie z następującą strukturą:
   
   ```
   dist/
   ├── index.php
   ├── oferta.php
   ├── galeria.php
   ├── kontakt.php
   ├── includes/
   │   ├── header.php
   │   ├── footer.php
   │   └── config.php (opcjonalnie dla ustawień)
   ├── assets/
   │   ├── css/
   │   ├── js/
   │   └── images/
   └── uploads/ (dla przyszłych zdjęć galerii)
   ```

6. **Dokumentacja**: Stwórz dokumentację w katalogu `docs/` zawierającą:
   
   - `INSTALACJA.md`: Instrukcję instalacji i konfiguracji na serwerze (wymagania PHP, Apache/Nginx)
   - `STRUKTURA.md`: Opis struktury projektu z wyjaśnieniem roli każdego pliku
   - `EDYCJA_TRESCI.md`: Wyjaśnienie jak edytować treści na stronie (gdzie znajdują się teksty, jak dodać zdjęcia do galerii)
   - `WYMAGANIA.md`: Wymagania serwerowe (PHP 7.4+, mod_rewrite, uprawnienia katalogów)

7. **Prompty dla GitHub Copilot**: Stwórz prompty w języku polskim w katalogu `prompts/` zawierające:
   
   - Kontekst projektu (firma malarska, Bootstrap, PHP)
   - Instrukcje dla poszczególnych zadań (np. "Stwórz formularz kontaktowy dla firmy malarskiej z walidacją PHP")
   - Wymagania dotyczące stylu kodu i najlepszych praktyk
   - Referencje do struktury projektu i lokalizacji plików

8. **Obsługa błędów i brakujących informacji**: Gdy napotkasz niejasności:
   
   - Sprawdź katalogi `knowledge/` i `instructions/` w poszukiwaniu dodatkowych wytycznych
   - Jeśli brakuje konkretnych treści tekstowych z `text/`, zaznacz miejsca wymagające uzupełnienia komentarzami PHP w formacie: `<!-- TODO: Uzupełnić treść z text/nazwa_pliku.txt -->`
   - Dla galerii przygotuj strukturę z placeholder images i instrukcją w komentarzu jak dodać rzeczywiste zdjęcia
   - W przypadku braku szczegółowych informacji zastosuj najlepsze praktyki branżowe dla firm usługowych (profesjonalny ton, focus na jakość i doświadczenie)

9. **Walidacja końcowa**: Przed zakończeniem upewnij się, że:
   
   - Wszystkie cztery podstrony są w pełni funkcjonalne i poprawnie renderują się w przeglądarce
   - Nawigacja działa poprawnie między wszystkimi stronami (aktywna strona jest oznaczona w menu)
   - Dane kontaktowe (telefon +48 452 690 824, www.malarz.trzebnica.pl) są widoczne na każdej stronie (w stopce lub nagłówku) i poprawnie sformatowane
   - Slogan "Precision, Perfection, Professional" jest odpowiednio wyeksponowany na stronie głównej (hero section lub prominent placement)
   - Formularz kontaktowy zawiera walidację i zabezpieczenia
   - Galeria jest przygotowana do prezentacji trzech kategorii zdjęć (wnętrza, elewacje, detale)
   - Wszystkie ścieżki do zasobów są poprawne i działają
   - Kod jest czysty, skomentowany po polsku i gotowy do produkcji w `dist/`
   - Strona jest w pełni responsywna i testowana na różnych urządzeniach
   - Meta tagi SEO są zaimplementowane dla każdej podstrony

Asystent powinien pracować metodycznie, krok po kroku, zapewniając najwyższą jakość kodu i profesjonalny wygląd strony odpowiadający charakterowi firmy malarskiej. Projekt musi być gotowy do natychmiastowego wdrożenia produkcyjnego. Wszystkie prompty i komentarze w kodzie powinny być w języku polskim. Struktura PHP musi być modułowa z wykorzystaniem includes dla header i footer, umożliwiając łatwą konserwację i rozbudowę w przyszłości.

# Instalacja - Malarz Trzebnica

Kompletny przewodnik instalacji strony internetowej **www.malarz.trzebnica.pl**

---

## 📋 Spis treści

1. [Wymagania systemowe](#wymagania-systemowe)
2. [Instalacja lokalna](#instalacja-lokalna)
3. [Instalacja na serwerze produkcyjnym](#instalacja-na-serwerze-produkcyjnym)
4. [Konfiguracja bazy danych](#konfiguracja-bazy-danych)
5. [Ustawienia uprawnień](#ustawienia-uprawnień)
6. [Konfiguracja .htaccess](#konfiguracja-htaccess)
7. [Testowanie instalacji](#testowanie-instalacji)
8. [Rozwiązywanie problemów](#rozwiązywanie-problemów)

---

## 🖥️ Wymagania systemowe

### Wymagania minimalne

| Komponent | Minimalna wersja | Zalecana wersja |
|-----------|------------------|-----------------|
| **PHP** | 7.4 | 8.1+ |
| **Serwer WWW** | Apache 2.4 / Nginx 1.18 | Apache 2.4.52+ |
| **MySQL** (opcjonalnie) | 5.7 | 8.0+ |
| **SSL** | TLS 1.2 | TLS 1.3 |
| **Pamięć PHP** | 128MB | 256MB+ |

### Rozszerzenia PHP (wymagane)

```bash
# Sprawdź zainstalowane rozszerzenia
php -m

# Wymagane rozszerzenia:
- mbstring      # Obsługa znaków UTF-8
- json          # Parsowanie JSON
- xml           # XML processing
- ctype         # Character type checking
- fileinfo      # Informacje o plikach
- filter        # Filtrowanie danych
- session       # Obsługa sesji
- curl          # HTTP requests (dla formularza)
```

### Moduły Apache (wymagane)

```apache
# W pliku httpd.conf lub przez a2enmod
LoadModule rewrite_module modules/mod_rewrite.so
LoadModule headers_module modules/mod_headers.so
LoadModule expires_module modules/mod_expires.so
LoadModule deflate_module modules/mod_deflate.so
```

### Narzędzia deweloperskie (opcjonalnie)

```bash
# Composer - do zarządzania zależnościami
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# Git - do klonowania repozytorium
apt-get install git  # Debian/Ubuntu
yum install git      # CentOS/RHEL
```

---

## 💻 Instalacja lokalna

### Krok 1: Klonowanie repozytorium

```bash
# Przejdź do katalogu roboczego
cd ~/projekty/

# Sklonuj repozytorium
git clone https://github.com/user/malarz-trzebnica-php.git
cd malarz-trzebnica-php
```

### Krok 2: Instalacja zależności

```bash
# Zainstaluj zależności PHP przez Composer
composer install

# Opcjonalnie: Zainstaluj narzędzia deweloperskie
composer install --dev
```

### Krok 3: Konfiguracja środowiska

```bash
# Skopiuj przykładowy plik konfiguracyjny
cp dist/includes/config.example.php dist/includes/config.php

# Edytuj plik konfiguracyjny
nano dist/includes/config.php
```

**Przykładowa konfiguracja `config.php`:**

```php
<?php
// Konfiguracja środowiska
define('ENVIRONMENT', 'development'); // development | production

// Dane strony
define('SITE_NAME', 'Malarz Trzebnica');
define('SITE_URL', 'http://localhost:8000');
define('SITE_EMAIL', 'kontakt@malarz.trzebnica.pl');
define('SITE_PHONE', '+48 452 690 824');

// Ustawienia formularza kontaktowego
define('CONTACT_EMAIL', 'kontakt@malarz.trzebnica.pl');
define('ENABLE_CAPTCHA', false); // true dla produkcji

// Ścieżki
define('BASE_PATH', __DIR__ . '/..');
define('ASSETS_PATH', SITE_URL . '/assets');
define('UPLOADS_PATH', BASE_PATH . '/uploads');

// Bezpieczeństwo
define('CSRF_TOKEN_NAME', 'csrf_token');
define('SESSION_NAME', 'MALARZ_SESSION');

// Debugowanie (wyłącz na produkcji!)
if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
?>
```

### Krok 4: Uruchomienie serwera lokalnego

#### Opcja A: PHP Built-in Server (najprostsze)

```bash
# Przejdź do katalogu dist/
cd dist/

# Uruchom serwer na porcie 8000
php -S localhost:8000

# Alternatywnie z głównego katalogu
php -S localhost:8000 -t dist/
```

Otwórz przeglądarkę: **http://localhost:8000**

#### Opcja B: XAMPP (Windows/Mac/Linux)

1. Zainstaluj [XAMPP](https://www.apachefriends.org/)
2. Skopiuj katalog `dist/` do `C:\xampp\htdocs\malarz-trzebnica\`
3. Uruchom Apache w XAMPP Control Panel
4. Otwórz: **http://localhost/malarz-trzebnica/**

#### Opcja C: WAMP (Windows)

1. Zainstaluj [WAMP](https://www.wampserver.com/)
2. Skopiuj `dist/` do `C:\wamp64\www\malarz-trzebnica\`
3. Uruchom WAMP
4. Otwórz: **http://localhost/malarz-trzebnica/**

#### Opcja D: MAMP (Mac)

1. Zainstaluj [MAMP](https://www.mamp.info/)
2. Skopiuj `dist/` do `/Applications/MAMP/htdocs/malarz-trzebnica/`
3. Uruchom MAMP
4. Otwórz: **http://localhost:8888/malarz-trzebnica/**

#### Opcja E: Docker (dla zaawansowanych)

```bash
# Uruchom z docker-compose
docker-compose up -d

# Otwórz http://localhost:8080
```

### Krok 5: Weryfikacja instalacji

Sprawdź, czy wszystkie strony działają:

- ✅ http://localhost:8000/ (Strona główna)
- ✅ http://localhost:8000/oferta.php (Oferta)
- ✅ http://localhost:8000/galeria.php (Galeria)
- ✅ http://localhost:8000/kontakt.php (Kontakt)

---

## 🌐 Instalacja na serwerze produkcyjnym

### Krok 1: Przygotowanie serwera

#### A. Połączenie SSH

```bash
# Połącz się z serwerem
ssh user@malarz.trzebnica.pl

# Lub jeśli używasz niestandardowego portu
ssh -p 2222 user@malarz.trzebnica.pl
```

#### B. Sprawdzenie wersji PHP

```bash
# Sprawdź wersję PHP
php -v

# Jeśli wersja < 7.4, zaktualizuj
sudo apt-get update
sudo apt-get install php8.1 php8.1-mbstring php8.1-xml php8.1-curl
```

#### C. Instalacja Composer (jeśli nie ma)

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### Krok 2: Upload plików

#### Opcja A: Git (zalecane)

```bash
# Przejdź do katalogu public_html lub httpdocs
cd /var/www/html  # lub ~/public_html

# Sklonuj repozytorium
git clone https://github.com/user/malarz-trzebnica-php.git .

# Zainstaluj zależności
composer install --no-dev --optimize-autoloader
```

#### Opcja B: FTP/SFTP

Użyj klienta FTP (FileZilla, Cyberduck):

1. Połącz się z serwerem FTP
   - Host: `ftp.malarz.trzebnica.pl`
   - Port: `21` (FTP) lub `22` (SFTP)
   - Użytkownik: Twój login FTP
   - Hasło: Twoje hasło FTP

2. Upload zawartości katalogu `dist/` do `public_html/` lub `httpdocs/`

3. Zachowaj strukturę katalogów:
   ```
   public_html/
   ├── index.php
   ├── oferta.php
   ├── galeria.php
   ├── kontakt.php
   ├── includes/
   ├── assets/
   └── .htaccess
   ```

#### Opcja C: rsync (dla zaawansowanych)

```bash
# Synchronizacja z lokalnego komputera na serwer
rsync -avz --delete \
  --exclude='.git' \
  --exclude='node_modules' \
  --exclude='.env' \
  ./dist/ user@malarz.trzebnica.pl:/var/www/html/
```

### Krok 3: Konfiguracja produkcyjna

```bash
# Edytuj config.php na serwerze
nano /var/www/html/includes/config.php

# Zmień środowisko na production
define('ENVIRONMENT', 'production');
define('SITE_URL', 'https://www.malarz.trzebnica.pl');

# Wyłącz display_errors
ini_set('display_errors', 0);
```

### Krok 4: Ustawienia DNS i SSL

#### A. Konfiguracja DNS

W panelu domeny (np. home.pl, OVH):

```
Typ    Nazwa             Wartość                    TTL
A      @                 XXX.XXX.XXX.XXX           3600
A      www               XXX.XXX.XXX.XXX           3600
CNAME  www               malarz.trzebnica.pl       3600
```

#### B. Certyfikat SSL (Let's Encrypt - DARMOWY)

```bash
# Zainstaluj Certbot
sudo apt-get install certbot python3-certbot-apache

# Wygeneruj certyfikat
sudo certbot --apache -d malarz.trzebnica.pl -d www.malarz.trzebnica.pl

# Auto-renewal (automatyczne odnawianie)
sudo certbot renew --dry-run
```

**Lub przez panel hostingowy:**
1. Zaloguj się do cPanel/Plesk
2. Znajdź "SSL/TLS" lub "Let's Encrypt"
3. Wybierz domenę i kliknij "Install"

---

## 🗄️ Konfiguracja bazy danych

> **Uwaga:** Aktualnie projekt **NIE** wymaga bazy danych. Formularz kontaktowy działa przez email.

Jeśli w przyszłości zdecydujesz się na dodanie bazy danych (np. dla bloga):

### Utworzenie bazy danych

#### A. Przez phpMyAdmin

1. Zaloguj się do phpMyAdmin
2. Zakładka "Databases" → Nowa baza
3. Nazwa: `malarz_trzebnica_db`
4. Collation: `utf8mb4_unicode_ci`
5. Kliknij "Create"

#### B. Przez MySQL CLI

```sql
-- Połącz się z MySQL
mysql -u root -p

-- Utwórz bazę danych
CREATE DATABASE malarz_trzebnica_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Utwórz użytkownika
CREATE USER 'malarz_user'@'localhost' IDENTIFIED BY 'strong_password_here';

-- Nadaj uprawnienia
GRANT ALL PRIVILEGES ON malarz_trzebnica_db.* TO 'malarz_user'@'localhost';
FLUSH PRIVILEGES;

-- Wyjdź
EXIT;
```

#### C. Konfiguracja połączenia w PHP

```php
// W dist/includes/config.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'malarz_trzebnica_db');
define('DB_USER', 'malarz_user');
define('DB_PASS', 'strong_password_here');
define('DB_CHARSET', 'utf8mb4');

// Przykładowe połączenie PDO
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch(PDOException $e) {
    die("Błąd połączenia z bazą danych: " . $e->getMessage());
}
```

---

## 🔐 Ustawienia uprawnień

### Linux/Unix/Mac (przez SSH)

```bash
# Przejdź do katalogu strony
cd /var/www/html

# Ustaw właściciela (zazwyczaj www-data lub apache)
sudo chown -R www-data:www-data .

# Ustaw uprawnienia dla katalogów (755)
find . -type d -exec chmod 755 {} \;

# Ustaw uprawnienia dla plików (644)
find . -type f -exec chmod 644 {} \;

# Katalog uploads musi być zapisywalny
chmod -R 775 uploads/
chown -R www-data:www-data uploads/

# Plik .htaccess (644)
chmod 644 .htaccess

# Pliki konfiguracyjne (400 - tylko odczyt dla właściciela)
chmod 400 includes/config.php
```

### Windows (XAMPP/WAMP)

```batch
# Uprawnienia zazwyczaj nie są problemem
# Upewnij się, że katalog uploads/ jest zapisywalny
icacls "C:\xampp\htdocs\malarz-trzebnica\uploads" /grant Users:(OI)(CI)F
```

### Sprawdzenie uprawnień

```bash
# Lista uprawnień
ls -la

# Przykładowy poprawny wynik:
# drwxr-xr-x  5 www-data www-data  4096 assets/
# -rw-r--r--  1 www-data www-data  2048 index.php
# drwxrwxr-x  2 www-data www-data  4096 uploads/
# -rw-r-----  1 www-data www-data  1024 includes/config.php
```

---

## ⚙️ Konfiguracja .htaccess

Plik `.htaccess` w katalogu `dist/` jest już skonfigurowany. Upewnij się, że:

### 1. mod_rewrite jest włączony

```bash
# Apache (Linux)
sudo a2enmod rewrite
sudo systemctl restart apache2

# Apache (Windows XAMPP)
# Odkomentuj w httpd.conf:
LoadModule rewrite_module modules/mod_rewrite.so
```

### 2. AllowOverride jest ustawiony

W konfiguracji Apache (`/etc/apache2/sites-available/000-default.conf`):

```apache
<Directory /var/www/html>
    Options Indexes FollowSymLinks
    AllowOverride All  # Musi być "All", nie "None"
    Require all granted
</Directory>
```

### 3. Testowanie friendly URLs

Po konfiguracji, te URL-e powinny działać:

```
https://www.malarz.trzebnica.pl/
https://www.malarz.trzebnica.pl/oferta
https://www.malarz.trzebnica.pl/galeria
https://www.malarz.trzebnica.pl/kontakt
```

---

## ✅ Testowanie instalacji

### 1. Checklist podstawowy

- [ ] Strona główna ładuje się poprawnie
- [ ] Wszystkie 4 podstrony są dostępne
- [ ] Obrazy i CSS się ładują
- [ ] JavaScript działa (animacje, slideshow)
- [ ] Formularz kontaktowy wyświetla się
- [ ] Nawigacja działa między stronami
- [ ] Strona jest responsywna (sprawdź na mobile)

### 2. Test formularza kontaktowego

```bash
# Wyślij testowy email
curl -X POST http://localhost:8000/kontakt.php \
  -d "name=Test&email=test@example.com&message=Test message"

# Sprawdź logi PHP
tail -f /var/log/apache2/error.log
```

### 3. Test wydajności

```bash
# Sprawdź czas odpowiedzi
curl -o /dev/null -s -w "%{time_total}\n" http://localhost:8000/

# Lighthouse audit (w Chrome DevTools)
# Naciśnij F12 → Lighthouse → Generate report

# PageSpeed Insights
https://pagespeed.web.dev/analysis?url=https://www.malarz.trzebnica.pl
```

### 4. Test bezpieczeństwa

```bash
# Sprawdź nagłówki bezpieczeństwa
curl -I https://www.malarz.trzebnica.pl

# Sprawdź SSL
openssl s_client -connect malarz.trzebnica.pl:443 -servername malarz.trzebnica.pl
```

---

## 🔧 Rozwiązywanie problemów

### Problem 1: "500 Internal Server Error"

**Przyczyny:**
- Błąd w pliku `.htaccess`
- mod_rewrite nie jest włączony
- Błąd składni PHP

**Rozwiązanie:**
```bash
# Sprawdź logi błędów
tail -100 /var/log/apache2/error.log

# Wyłącz .htaccess tymczasowo
mv .htaccess .htaccess.bak

# Sprawdź składnię PHP
php -l dist/index.php
```

### Problem 2: "404 Not Found" dla podstron

**Przyczyny:**
- mod_rewrite nie działa
- AllowOverride nie jest ustawiony na "All"

**Rozwiązanie:**
```bash
# Włącz mod_rewrite
sudo a2enmod rewrite
sudo systemctl restart apache2

# Sprawdź AllowOverride w vhost config
sudo nano /etc/apache2/sites-available/000-default.conf
```

### Problem 3: Strona ładuje się bez CSS/JS

**Przyczyny:**
- Złe ścieżki do plików CSS/JS
- Problem z uprawnieniami

**Rozwiązanie:**
```bash
# Sprawdź ścieżki w header.php
grep -n "assets" dist/includes/header.php

# Sprawdź uprawnienia
ls -la dist/assets/

# Popraw uprawnienia
chmod -R 755 dist/assets/
```

### Problem 4: Formularz nie wysyła emaili

**Przyczyny:**
- Funkcja `mail()` nie jest skonfigurowana
- Brak uprawnień do wysyłki
- Spam filter blokuje

**Rozwiązanie:**
```bash
# Sprawdź konfigurację PHP mail
php -i | grep -i sendmail

# Testuj wysyłkę
php -r "mail('test@example.com', 'Test', 'Test message');"

# Alternatywnie użyj PHPMailer (już zainstalowany przez Composer)
```

### Problem 5: "Permission denied" dla uploads/

**Rozwiązanie:**
```bash
# Nadaj uprawnienia zapisu
chmod -R 775 dist/uploads/
chown -R www-data:www-data dist/uploads/

# Sprawdź SELinux (jeśli włączony)
sudo chcon -R -t httpd_sys_rw_content_t dist/uploads/
```

---

## 📞 Wsparcie

W razie problemów z instalacją:

- **Email:** kontakt@malarz.trzebnica.pl
- **Telefon:** +48 452 690 824
- **GitHub Issues:** [https://github.com/user/malarz-trzebnica-php/issues](https://github.com/user/malarz-trzebnica-php/issues)
- **Dokumentacja:** Zobacz `docs/` w repozytorium

---

## 📚 Dalsze kroki

Po pomyślnej instalacji:

1. Przeczytaj `docs/STRUKTURA.md` - opis architektury projektu
2. Przeczytaj `docs/EDYCJA_TRESCI.md` - jak edytować treści
3. Przeczytaj `docs/SEO.md` - optymalizacja SEO
4. Przeczytaj `docs/BEZPIECZENSTWO.md` - najlepsze praktyki bezpieczeństwa

---

**Malarz Trzebnica** - Precision, Perfection, Professional 🎨

Copyright © 2024-2025 Malarz Trzebnica. Wszystkie prawa zastrzeżone.

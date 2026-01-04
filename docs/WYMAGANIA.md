# Wymagania Techniczne - Malarz Trzebnica

Szczegółowe wymagania techniczne serwera dla **www.malarz.trzebnica.pl**

---

## 🖥️ Wymagania serwera

### Minimalne wymagania

| Komponent | Wersja minimalna | Wersja zalecana |
|-----------|------------------|-----------------|
| **PHP** | 7.4.0 | 8.1+ |
| **Apache** | 2.4.0 | 2.4.52+ |
| **MySQL** (opcjonalnie) | 5.7 | 8.0+ |
| **RAM** | 512 MB | 1 GB+ |
| **Dysk** | 1 GB | 5 GB+ |
| **SSL/TLS** | 1.2 | 1.3 |

---

## 📦 Rozszerzenia PHP (wymagane)

```ini
# Sprawdź zainstalowane rozszerzenia
php -m

# Wymagane:
extension=mbstring      # UTF-8 string handling
extension=json          # JSON parsing
extension=xml           # XML processing
extension=ctype         # Character type checking
extension=fileinfo      # File type detection
extension=filter        # Data filtering
extension=session       # Session management
extension=curl          # HTTP requests (dla PHPMailer)
extension=openssl       # SSL/TLS dla SMTP
extension=pdo           # Database abstraction (opcjonalnie)
extension=pdo_mysql     # MySQL driver (opcjonalnie)
extension=gd            # Image manipulation (opcjonalnie)
extension=zip           # Archiwizacja (opcjonalnie)
```

### Instalacja rozszerzeń

**Debian/Ubuntu:**
```bash
sudo apt-get update
sudo apt-get install php8.1-mbstring php8.1-xml php8.1-curl php8.1-gd php8.1-mysql
```

**CentOS/RHEL:**
```bash
sudo yum install php-mbstring php-xml php-json php-gd php-mysqlnd
```

**Windows (XAMPP):**
Odkomentuj w `php.ini`:
```ini
extension=mbstring
extension=openssl
extension=curl
extension=gd2
```

---

## ⚙️ Konfiguracja PHP (`php.ini`)

### Rekomendowane ustawienia

```ini
# Memory limit
memory_limit = 256M

# Upload limits (dla galerii)
upload_max_filesize = 10M
post_max_size = 10M
max_file_uploads = 20

# Execution time
max_execution_time = 60
max_input_time = 60

# Error reporting (PRODUKCJA)
display_errors = Off
display_startup_errors = Off
error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT
log_errors = On
error_log = /var/log/php_errors.log

# Error reporting (DEVELOPMENT)
display_errors = On
display_startup_errors = On
error_reporting = E_ALL

# Session
session.cookie_httponly = 1
session.cookie_secure = 1    # Tylko dla HTTPS
session.use_only_cookies = 1
session.cookie_samesite = Strict

# Security
expose_php = Off
allow_url_fopen = On
allow_url_include = Off

# Output buffering
output_buffering = 4096

# Timezone
date.timezone = Europe/Warsaw
```

---

## 🌐 Moduły Apache (wymagane)

### Lista wymaganych modułów

```apache
LoadModule rewrite_module modules/mod_rewrite.so
LoadModule headers_module modules/mod_headers.so
LoadModule expires_module modules/mod_expires.so
LoadModule deflate_module modules/mod_deflate.so
LoadModule ssl_module modules/mod_ssl.so
LoadModule mime_module modules/mod_mime.so
LoadModule dir_module modules/mod_dir.so
LoadModule filter_module modules/mod_filter.so
```

### Włączanie modułów

**Debian/Ubuntu:**
```bash
sudo a2enmod rewrite
sudo a2enmod headers
sudo a2enmod expires
sudo a2enmod deflate
sudo a2enmod ssl
sudo systemctl restart apache2
```

**CentOS/RHEL:**
Odkomentuj w `/etc/httpd/conf/httpd.conf`

**Windows (XAMPP):**
Odkomentuj w `httpd.conf`:
```apache
LoadModule rewrite_module modules/mod_rewrite.so
LoadModule headers_module modules/mod_headers.so
```

---

## 🔧 Konfiguracja mod_rewrite

### Apache VirtualHost

```apache
<VirtualHost *:80>
    ServerName malarz.trzebnica.pl
    ServerAlias www.malarz.trzebnica.pl
    DocumentRoot /var/www/html
    
    <Directory /var/www/html>
        Options -Indexes +FollowSymLinks
        AllowOverride All     # MUSI BYĆ "All"
        Require all granted
    </Directory>
    
    # Logs
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

<VirtualHost *:443>
    ServerName malarz.trzebnica.pl
    ServerAlias www.malarz.trzebnica.pl
    DocumentRoot /var/www/html
    
    SSLEngine on
    SSLCertificateFile /etc/letsencrypt/live/malarz.trzebnica.pl/fullchain.pem
    SSLCertificateKeyFile /etc/letsencrypt/live/malarz.trzebnica.pl/privkey.pem
    
    <Directory /var/www/html>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/ssl_error.log
    CustomLog ${APACHE_LOG_DIR}/ssl_access.log combined
</VirtualHost>
```

### Test konfiguracji

```bash
# Sprawdź składnię Apache
sudo apache2ctl configtest

# Restart Apache
sudo systemctl restart apache2

# Sprawdź status
sudo systemctl status apache2
```

---

## 🗄️ Wymagania bazy danych (opcjonalnie)

> Aktualnie projekt **NIE** wymaga bazy danych.

Jeśli w przyszłości dodasz bazę danych:

### MySQL/MariaDB

**Minimalna wersja:** MySQL 5.7 lub MariaDB 10.3

**Konfiguracja:**
```sql
CREATE DATABASE malarz_trzebnica_db 
    CHARACTER SET utf8mb4 
    COLLATE utf8mb4_unicode_ci;

CREATE USER 'malarz_user'@'localhost' IDENTIFIED BY 'strong_password';
GRANT ALL PRIVILEGES ON malarz_trzebnica_db.* TO 'malarz_user'@'localhost';
FLUSH PRIVILEGES;
```

**PHP PDO connection:**
```php
$pdo = new PDO(
    'mysql:host=localhost;dbname=malarz_trzebnica_db;charset=utf8mb4',
    'malarz_user',
    'strong_password',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]
);
```

---

## 📧 Konfiguracja wysyłki email

### Metoda 1: PHP mail() (podstawowa)

**Wymagania:**
- Zainstalowany i skonfigurowany `sendmail` lub `postfix`

**Konfiguracja w `php.ini`:**
```ini
[mail function]
SMTP = localhost
smtp_port = 25
sendmail_path = /usr/sbin/sendmail -t -i
```

**Test:**
```bash
php -r "mail('test@example.com', 'Test', 'Test message');"
```

---

### Metoda 2: PHPMailer przez SMTP (zalecane)

**Instalacja przez Composer:**
```bash
composer require phpmailer/phpmailer
```

**Przykład konfiguracji:**
```php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.example.com';
$mail->SMTPAuth = true;
$mail->Username = 'kontakt@malarz.trzebnica.pl';
$mail->Password = 'your_password';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

// Recipients
$mail->setFrom('kontakt@malarz.trzebnica.pl', 'Malarz Trzebnica');
$mail->addAddress('kontakt@malarz.trzebnica.pl');

// Content
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Subject = 'Nowa wiadomość z formularza kontaktowego';
$mail->Body = $message;

$mail->send();
```

---

## 🔒 Certyfikat SSL/TLS

### Let's Encrypt (DARMOWY - zalecane)

**Instalacja Certbot:**
```bash
# Ubuntu/Debian
sudo apt-get install certbot python3-certbot-apache

# CentOS/RHEL
sudo yum install certbot python3-certbot-apache
```

**Generowanie certyfikatu:**
```bash
sudo certbot --apache -d malarz.trzebnica.pl -d www.malarz.trzebnica.pl
```

**Auto-renewal:**
```bash
# Test renewal
sudo certbot renew --dry-run

# Cron job (automatyczne odnawianie)
sudo crontab -e

# Dodaj linię:
0 3 * * * /usr/bin/certbot renew --quiet
```

---

### Cloudflare SSL (alternatywa)

1. Załóż konto na [Cloudflare](https://www.cloudflare.com/)
2. Dodaj swoją domenę
3. Zmień nameservery u rejestratora domeny
4. SSL/TLS → Full (Strict)
5. Edge Certificates → Always Use HTTPS: ON

---

## 💾 Uprawnienia katalogów

### Linux/Unix permissions

```bash
# Przejdź do katalogu strony
cd /var/www/html

# Właściciel (www-data lub apache)
sudo chown -R www-data:www-data .

# Uprawnienia katalogów (755)
find . -type d -exec chmod 755 {} \;

# Uprawnienia plików (644)
find . -type f -exec chmod 644 {} \;

# Katalog uploads (zapisywalny)
chmod 775 uploads/
chown www-data:www-data uploads/

# Pliki konfiguracyjne (400 - tylko odczyt)
chmod 400 includes/config.php
```

### Sprawdzenie właściciela procesu Apache

```bash
# Ubuntu/Debian
ps aux | grep apache2 | head -1
# Zwykle: www-data

# CentOS/RHEL
ps aux | grep httpd | head -1
# Zwykle: apache
```

---

## 🧪 Weryfikacja wymagań

### Checklist instalacji

```bash
# 1. Sprawdź wersję PHP
php -v
# Wymagane: >= 7.4

# 2. Sprawdź rozszerzenia PHP
php -m | grep -E 'mbstring|json|xml|curl|openssl'

# 3. Sprawdź mod_rewrite
apache2ctl -M | grep rewrite
# Powinno pokazać: rewrite_module

# 4. Sprawdź AllowOverride
grep -r "AllowOverride" /etc/apache2/sites-available/
# Powinno być: AllowOverride All

# 5. Test .htaccess
curl -I http://localhost/oferta
# Powinno zwrócić 200 OK (nie 404)

# 6. Sprawdź uprawnienia
ls -la /var/www/html/uploads/
# Powinno być: drwxrwxr-x www-data www-data

# 7. Test wysyłki email
php -r "mail('test@example.com', 'Test', 'Test');"
# Sprawdź skrzynkę email
```

---

## 📊 Wymagania wydajności

### Apache MPM (Multi-Processing Module)

**Zalecane: MPM Event** (dla PHP-FPM)

```apache
<IfModule mpm_event_module>
    StartServers             2
    MinSpareThreads          25
    MaxSpareThreads          75
    ThreadLimit              64
    ThreadsPerChild          25
    MaxRequestWorkers        150
    MaxConnectionsPerChild   0
</IfModule>
```

### PHP-FPM Pool

```ini
[malarz]
user = www-data
group = www-data
listen = /run/php/php8.1-fpm.sock
listen.owner = www-data
listen.group = www-data
pm = dynamic
pm.max_children = 50
pm.start_servers = 5
pm.min_spare_servers = 5
pm.max_spare_servers = 35
pm.max_requests = 500
```

---

## 📞 Kontakt

W razie problemów z wymaganiami:

- **Email:** kontakt@malarz.trzebnica.pl
- **Telefon:** +48 452 690 824
- **Dokumentacja:** `docs/INSTALACJA.md`

---

**Malarz Trzebnica** - Precision, Perfection, Professional 🎨

Copyright © 2024-2025 Malarz Trzebnica. Wszystkie prawa zastrzeżone.

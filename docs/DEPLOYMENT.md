# Deployment - Malarz Trzebnica

## 1. Wstęp

Instrukcja wdrożenia aplikacji **Malarz Trzebnica** na domenę **www.malarz.trzebnica.pl**. Zawiera konfigurację DNS, SSL, serwera oraz monitoring.

### Wymagania:
- Hosting z PHP 7.4+ i MySQL 5.7+
- Domena: malarz.trzebnica.pl
- SSL Certificate (Let's Encrypt)
- SSH dostęp do serwera
- Composer zainstalowany

---

## 2. Architektura Deployment'u

```
┌─────────────────────────────────────────┐
│          Domain: malarz.trzebnica.pl    │
│         (DNS pointing to server)        │
└────────────────┬────────────────────────┘
                 │
        ┌────────▼────────┐
        │   Load Balancer │ (opcjonalnie)
        └────────┬────────┘
                 │
     ┌───────────┴───────────┐
     │   Web Server (Nginx)  │
     │   Port 80 → 443       │
     └───────────┬───────────┘
                 │
     ┌───────────▼───────────┐
     │  PHP-FPM (8 workers)  │
     └───────────┬───────────┘
                 │
     ┌───────────▼───────────┐
     │   MySQL Database      │
     │   Backup schedule     │
     └───────────────────────┘
```

---

## 3. Przygotowanie Serwera

### 3.1 Aktualizacja Systemu

```bash
# Zaloguj się na serwer
ssh root@twoj-serwer.com

# Aktualizuj system
apt update && apt upgrade -y

# Zainstaluj niezbędne narzędzia
apt install -y \
    curl \
    wget \
    git \
    zip \
    unzip \
    build-essential \
    htop \
    nano \
    git

# Ustaw timezone
timedatectl set-timezone Europe/Warsaw
```

### 3.2 Instalacja PHP

```bash
# Dodaj PPA dla PHP
apt install -y software-properties-common
add-apt-repository ppa:ondrej/php
apt update

# Zainstaluj PHP 8.1 z rozszerzeniami
apt install -y \
    php8.1-fpm \
    php8.1-cli \
    php8.1-mysql \
    php8.1-mbstring \
    php8.1-xml \
    php8.1-curl \
    php8.1-gd \
    php8.1-zip \
    php8.1-json \
    php8.1-intl

# Sprawdzaj wersję
php --version
```

### 3.3 Instalacja MySQL

```bash
# Zainstaluj MySQL 8.0
apt install -y mysql-server

# Asekuruj instalację
mysql_secure_installation

# Zaloguj się do MySQL
mysql -u root -p

# Utwórz bazę danych
CREATE DATABASE malarz_trzebnica;
CREATE USER 'malarz_user'@'localhost' IDENTIFIED BY 'SecurePassword123!';
GRANT ALL PRIVILEGES ON malarz_trzebnica.* TO 'malarz_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 3.4 Instalacja Nginx

```bash
# Zainstaluj Nginx
apt install -y nginx

# Uruchom usługę
systemctl start nginx
systemctl enable nginx
systemctl status nginx
```

---

## 4. Konfiguracja DNS

### 4.1 A Record

```
Subdomena: @
Typ: A
Wartość: XXX.XXX.XXX.XXX (IP twojego serwera)
TTL: 3600
```

### 4.2 www Subdomena

```
Subdomena: www
Typ: CNAME
Wartość: malarz.trzebnica.pl
TTL: 3600
```

### 4.3 Mail Records (opcjonalnie)

```
Subdomena: @
Typ: MX
Wartość: mail.malarz.trzebnica.pl
Priorytet: 10

Subdomena: mail
Typ: A
Wartość: XXX.XXX.XXX.XXX
```

### 4.4 TXT Records (SPF, DKIM)

```
Subdomena: @
Typ: TXT
Wartość: "v=spf1 include:yourmail.com ~all"
```

### 4.5 Weryfikacja DNS

```bash
# Sprawdzaj czy DNS się rozwiązuje
dig malarz.trzebnica.pl
nslookup malarz.trzebnica.pl
host malarz.trzebnica.pl
```

---

## 5. Konfiguracja Nginx

### 5.1 Utwórz Virtual Host

**Plik: /etc/nginx/sites-available/malarz-trzebnica**

```nginx
# HTTP - Redirect do HTTPS
server {
    listen 80;
    listen [::]:80;
    server_name malarz.trzebnica.pl www.malarz.trzebnica.pl;
    
    # Let's Encrypt verification
    location /.well-known/acme-challenge/ {
        root /var/www/certbot;
    }
    
    # Wszystko inne przekierowuj do HTTPS
    location / {
        return 301 https://$server_name$request_uri;
    }
}

# HTTPS - Aplikacja
server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name malarz.trzebnica.pl www.malarz.trzebnica.pl;
    
    # SSL Certificate (Let's Encrypt)
    ssl_certificate /etc/letsencrypt/live/malarz.trzebnica.pl/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/malarz.trzebnica.pl/privkey.pem;
    
    # SSL Configuration
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;
    ssl_prefer_server_ciphers on;
    ssl_session_cache shared:SSL:10m;
    ssl_session_timeout 10m;
    
    # Security Headers
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;
    
    # Compression
    gzip on;
    gzip_vary on;
    gzip_types text/plain text/css text/xml text/javascript 
               application/x-javascript application/xml+rss;
    
    # Strona główna
    root /var/www/malarz-trzebnica/public;
    index index.php;
    
    # Logging
    access_log /var/log/nginx/malarz-trzebnica-access.log;
    error_log /var/log/nginx/malarz-trzebnica-error.log;
    
    # Limit request size (5MB)
    client_max_body_size 5M;
    
    # Blocklists
    location ~ /\. {
        deny all;
    }
    
    location ~ /config/ {
        deny all;
    }
    
    location ~ /storage/ {
        deny all;
    }
    
    # Static files
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
    
    # Rewrite URLs
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    # PHP
    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### 5.2 Enable Virtual Host

```bash
# Tworzymy symbolic link
ln -s /etc/nginx/sites-available/malarz-trzebnica /etc/nginx/sites-enabled/

# Sprawdzaj konfigurację
nginx -t

# Zrestartuj Nginx
systemctl restart nginx
```

---

## 6. Konfiguracja SSL (Let's Encrypt)

### 6.1 Instalacja Certbot

```bash
# Zainstaluj Certbot
apt install -y certbot python3-certbot-nginx

# Utwórz katalog dla weryfikacji
mkdir -p /var/www/certbot
```

### 6.2 Generowanie Certyfikatu

```bash
# Wygeneruj certifikat SSL
certbot certonly --webroot \
    -w /var/www/certbot \
    -d malarz.trzebnica.pl \
    -d www.malarz.trzebnica.pl \
    --agree-tos \
    --email kontakt@malarz.trzebnica.pl

# Lub automatyczne
certbot certonly --standalone \
    -d malarz.trzebnica.pl \
    -d www.malarz.trzebnica.pl
```

### 6.3 Auto-Renewal

```bash
# Sprawdzaj czy renewal działa
certbot renew --dry-run

# Dodaj do cron (automatyczne odnawianie)
systemctl enable certbot.timer
systemctl start certbot.timer

# Sprawdzaj status
systemctl status certbot.timer
```

---

## 7. Wdrożenie Aplikacji

### 7.1 Przygotuj Katalog Aplikacji

```bash
# Utwórz katalog
mkdir -p /var/www/malarz-trzebnica
cd /var/www/malarz-trzebnica

# Utwórz katalogi
mkdir -p storage/logs storage/cache storage/uploads public/assets

# Ustaw uprawnienia
chmod -R 755 storage
chmod -R 755 public
chown -R www-data:www-data /var/www/malarz-trzebnica
```

### 7.2 Zainstaluj Composera (Globalnie)

```bash
# Pobierz i zainstaluj Composer
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Sprawdzaj wersję
composer --version
```

### 7.3 Klonuj Aplikację

```bash
cd /var/www/malarz-trzebnica

# Klonuj z GitHub
git clone https://github.com/malarz-trzebnica/malarz-trzebnica-php.git .

# Lub skopiuj poprzez SCP
scp -r ./malarz-trzebnica-php/* root@twoj-serwer.com:/var/www/malarz-trzebnica/
```

### 7.4 Instalacja Zależności

```bash
cd /var/www/malarz-trzebnica

# Zainstaluj Composer dependencies
composer install --no-dev --optimize-autoloader

# Lub jeśli nie masz composer.json
composer update
```

### 7.5 Konfiguracja Aplikacji

```bash
# Utwórz .env (lub config/app.php)
cat > config/app.php << 'EOF'
<?php
return [
    'environment' => 'production',
    'debug' => false,
    'app_name' => 'Malarz Trzebnica',
    'app_url' => 'https://www.malarz.trzebnica.pl',
];
EOF

# Utwórz konfigurację bazy danych
cat > config/database.php << 'EOF'
<?php
return [
    'host' => 'localhost',
    'database' => 'malarz_trzebnica',
    'user' => 'malarz_user',
    'password' => 'SecurePassword123!',
];
EOF

# Ustaw właściwości
chmod 600 config/*.php
chown www-data:www-data config/*.php
```

### 7.6 Inicjalizacja Bazy Danych

```bash
# Zaloguj się do MySQL
mysql -u malarz_user -p malarz_trzebnica < database.sql

# Lub wykonaj manualnie migracje
mysql -u malarz_user -p -e "USE malarz_trzebnica;" < schema.sql
```

---

## 8. Konfiguracja PHP-FPM

### 8.1 Konfiguracja php.ini

**Plik: /etc/php/8.1/fpm/php.ini**

```ini
; Limit żądań
max_execution_time = 30
max_input_time = 60
memory_limit = 256M

; Upload limits
upload_max_filesize = 5M
post_max_size = 5M

; Logowanie błędów
display_errors = Off
display_startup_errors = Off
log_errors = On
error_log = /var/log/php-fpm-error.log

; Sesje
session.cookie_httponly = 1
session.cookie_secure = 1
session.cookie_samesite = Strict
session.use_strict_mode = 1

; Timezone
date.timezone = Europe/Warsaw

; Disable dangerous functions
disable_functions = exec,passthru,system,shell_exec,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source
```

### 8.2 Konfiguracja PHP-FPM

**Plik: /etc/php/8.1/fpm/pool.d/www.conf**

```ini
[www]
user = www-data
group = www-data

; Dynamiczny process manager
pm = dynamic
pm.max_children = 16
pm.start_servers = 4
pm.min_spare_servers = 2
pm.max_spare_servers = 8

; Timeout
request_terminate_timeout = 30

; Status page (do monitoringu)
pm.status_path = /status
```

### 8.3 Restart PHP-FPM

```bash
systemctl restart php8.1-fpm
systemctl status php8.1-fpm
```

---

## 9. Backup i Disaster Recovery

### 9.1 Backup Bazy Danych

```bash
# Utwórz katalog backups
mkdir -p /var/backups/malarz-trzebnica
chmod 700 /var/backups/malarz-trzebnica

# Skrypt do daily backup
cat > /usr/local/bin/backup-malarz-trzebnica.sh << 'EOF'
#!/bin/bash

BACKUP_DIR="/var/backups/malarz-trzebnica"
DB_NAME="malarz_trzebnica"
DB_USER="malarz_user"
DB_PASS="SecurePassword123!"
DATE=$(date +\%Y\%m\%d_\%H\%M\%S)

# Backup bazy danych
mysqldump -u$DB_USER -p$DB_PASS $DB_NAME | gzip > $BACKUP_DIR/database_$DATE.sql.gz

# Backup plików
tar -czf $BACKUP_DIR/files_$DATE.tar.gz /var/www/malarz-trzebnica/

# Usuń backups starsze niż 7 dni
find $BACKUP_DIR -type f -mtime +7 -delete

echo "Backup completed: $DATE"
EOF

# Ustaw uprawnienia
chmod +x /usr/local/bin/backup-malarz-trzebnica.sh

# Dodaj do cron (codziennie o 2:00 AM)
echo "0 2 * * * /usr/local/bin/backup-malarz-trzebnica.sh" | crontab -
```

### 9.2 Restore z Backup'u

```bash
# Restore bazy danych
gunzip < /var/backups/malarz-trzebnica/database_*.sql.gz | mysql -u malarz_user -p malarz_trzebnica

# Restore plików
tar -xzf /var/backups/malarz-trzebnica/files_*.tar.gz -C /

# Ustaw uprawnienia
chown -R www-data:www-data /var/www/malarz-trzebnica
```

---

## 10. Monitoring i Logging

### 10.1 Logowanie

```bash
# Sprawdzaj logi Nginx
tail -f /var/log/nginx/malarz-trzebnica-error.log
tail -f /var/log/nginx/malarz-trzebnica-access.log

# Sprawdzaj logi PHP
tail -f /var/log/php-fpm-error.log

# Sprawdzaj logi systemowe
journalctl -u nginx -f
journalctl -u php8.1-fpm -f
```

### 10.2 Monitorowanie Performance'u

```bash
# Instalacja monitoring tools
apt install -y htop iotop nethogs

# Sprawdzaj status procesów
htop

# Sprawdzaj disk usage
df -h
du -sh /var/www/malarz-trzebnica/*

# Sprawdzaj MySQL status
mysqladmin -u root -p status
```

### 10.3 Health Check Endpoint

**Plik: src/Controllers/HealthController.php**

```php
<?php
namespace App\Controllers;

class HealthController extends BaseController
{
    public function check()
    {
        $health = [
            'status' => 'healthy',
            'timestamp' => date('c'),
            'php_version' => PHP_VERSION,
            'database' => $this->checkDatabase(),
        ];
        
        header('Content-Type: application/json');
        echo json_encode($health);
        exit;
    }
    
    private function checkDatabase()
    {
        try {
            $this->db->query('SELECT 1');
            return 'connected';
        } catch (\Exception $e) {
            return 'disconnected';
        }
    }
}
```

**W routes.php:**
```php
$router->get('/health', 'HealthController@check');
```

**Test:**
```bash
curl https://www.malarz.trzebnica.pl/health
```

### 10.4 Uptime Monitoring

Użyj serwisu takie jak:
- UptimeRobot (darmowy)
- Pingdom
- StatusCake

Skonfiguruj monitorowanie `/health` endpoint'u

---

## 11. CI/CD Pipeline (opcjonalnie)

### 11.1 GitHub Actions

**Plik: .github/workflows/deploy.yml**

```yaml
name: Deploy to Production

on:
  push:
    branches:
      - main

jobs:
  deploy:
    runs-on: ubuntu-latest
    
    steps:
      - uses: actions/checkout@v2
      
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: 8.1
      
      - name: Install Composer
        run: composer install --no-dev
      
      - name: Run Tests
        run: composer test
      
      - name: Deploy to Server
        uses: appleboy/ssh-action@master
        with:
          host: ${{ secrets.SERVER_HOST }}
          username: ${{ secrets.SERVER_USER }}
          key: ${{ secrets.SERVER_SSH_KEY }}
          script: |
            cd /var/www/malarz-trzebnica
            git pull origin main
            composer install --no-dev
            systemctl restart php8.1-fpm
```

---

## 12. Troubleshooting

### Problem: 500 Internal Server Error

```bash
# Sprawdzaj logi
tail -f /var/log/nginx/malarz-trzebnica-error.log
tail -f /var/log/php-fpm-error.log

# Sprawdzaj uprawnienia
ls -la /var/www/malarz-trzebnica/
chown -R www-data:www-data /var/www/malarz-trzebnica
```

### Problem: 403 Forbidden

```bash
# Sprawdzaj uprawnienia na plikach
chmod 755 /var/www/malarz-trzebnica
chmod -R 755 /var/www/malarz-trzebnica/public
chmod -R 755 /var/www/malarz-trzebnica/storage
```

### Problem: Connection Refused

```bash
# Sprawdzaj czy MySQL słucha
netstat -tlnp | grep mysql

# Zrestartuj MySQL
systemctl restart mysql
```

### Problem: High Memory Usage

```bash
# Sprawdzaj procesy
ps aux | sort -nrk 4,4 | head -10

# Zmniejsz PHP-FPM workers
pm.max_children = 8
```

---

## 13. Security Hardening

### 13.1 Firewall (UFW)

```bash
# Zainstaluj UFW
apt install -y ufw

# Włącz firewall
ufw enable

# Zezwól na SSH
ufw allow 22/tcp

# Zezwól na HTTP/HTTPS
ufw allow 80/tcp
ufw allow 443/tcp

# Zablokuj wszystko inne
ufw default deny incoming
ufw default allow outgoing

# Sprawdzaj status
ufw status verbose
```

### 13.2 Fail2Ban (Brute Force Protection)

```bash
# Zainstaluj Fail2Ban
apt install -y fail2ban

# Konfiguracja
cat > /etc/fail2ban/jail.local << 'EOF'
[DEFAULT]
bantime = 3600
findtime = 600
maxretry = 5

[sshd]
enabled = true

[nginx-http-auth]
enabled = true

[nginx-noscript]
enabled = true
EOF

# Zrestartuj
systemctl restart fail2ban
systemctl status fail2ban
```

### 13.3 SSH Hardening

**Plik: /etc/ssh/sshd_config**

```
# Zmień port (opcjonalnie)
Port 2222

# Wyłącz root login
PermitRootLogin no

# Wyłącz password authentication
PubkeyAuthentication yes
PasswordAuthentication no

# Wyłącz X11
X11Forwarding no

# Limit connections
MaxAuthTries 3
MaxSessions 10
```

Zrestartuj:
```bash
systemctl restart sshd
```

---

## 14. Deployment Checklist

### Przed Deploymentem:
- ✅ Test aplikacji lokalnie
- ✅ Backup bazy danych
- ✅ Przygotuj config files
- ✅ Zainstaluj SSL certificate
- ✅ Konfiguruj DNS records
- ✅ Skonfiguruj .env variables

### Podczas Deploymentu:
- ✅ Clone/upload aplikacji
- ✅ Instalacja dependencies (composer)
- ✅ Run migrations
- ✅ Set correct permissions
- ✅ Restart PHP-FPM i Nginx
- ✅ Test aplikacji

### Po Deploymentu:
- ✅ Sprawdzaj logi
- ✅ Test wszystkich funkcji
- ✅ Monitoruj performance
- ✅ Setup backups
- ✅ Setup monitoring

---

## 15. Zero-Downtime Deployment (Advanced)

```bash
# 1. Utwórz nową wersję w osobnym katalogzie
mkdir /var/www/malarz-trzebnica-v2
cp -r /var/www/malarz-trzebnica/* /var/www/malarz-trzebnica-v2/

# 2. Zaktualizuj nową wersję
cd /var/www/malarz-trzebnica-v2
git pull
composer install

# 3. Zmień symlink (atomic operation)
ln -sfn /var/www/malarz-trzebnica-v2 /var/www/malarz-trzebnica-current
mv /var/www/malarz-trzebnica-current /var/www/malarz-trzebnica

# 4. Graceful reload Nginx
nginx -s reload

# 5. Jeśli coś pójdzie źle, rollback
ln -sfn /var/www/malarz-trzebnica-old /var/www/malarz-trzebnica
```

---

## Podsumowanie

Deployment aplikacji **Malarz Trzebnica** na www.malarz.trzebnica.pl obejmuje:

✅ Konfiguracja serwera (PHP, MySQL, Nginx)
✅ DNS i SSL/TLS
✅ Wdrożenie aplikacji
✅ Backup i monitoring
✅ Security hardening
✅ Zero-downtime deployment

Aplikacja powinna być dostępna pod adresem: **https://www.malarz.trzebnica.pl**

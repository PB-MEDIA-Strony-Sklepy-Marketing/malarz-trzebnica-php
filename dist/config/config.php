<?php

declare(strict_types=1);

/**
 * Główny plik konfiguracyjny aplikacji Malarz Trzebnica
 * 
 * @package MalarzTrzebnica
 */

// Ładowanie zmiennych środowiskowych
if (file_exists(__DIR__ . '/../../.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
    $dotenv->load();
}

return [
    // Podstawowa konfiguracja aplikacji
    'app' => [
        'name' => 'Malarz Trzebnica',
        'slogan' => 'Precision, Perfection, Professional',
        'url' => $_ENV['APP_URL'] ?? 'https://www.malarz.trzebnica.pl',
        'env' => $_ENV['APP_ENV'] ?? 'production',
        'debug' => filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN),
        'timezone' => 'Europe/Warsaw',
        'locale' => 'pl_PL',
    ],

    // Kontakt firmowy
    'company' => [
        'name' => 'Malarz Trzebnica',
        'phone' => '+48 452 690 824',
        'email' => 'kontakt@malarz.trzebnica.pl',
        'address' => [
            'city' => 'Trzebnica',
            'region' => 'Dolnośląskie',
            'country' => 'Polska',
        ],
    ],

    // Konfiguracja email (PHPMailer)
    'mail' => [
        'driver' => $_ENV['MAIL_DRIVER'] ?? 'smtp',
        'host' => $_ENV['MAIL_HOST'] ?? 'smtp.gmail.com',
        'port' => (int)($_ENV['MAIL_PORT'] ?? 587),
        'username' => $_ENV['MAIL_USERNAME'] ?? '',
        'password' => $_ENV['MAIL_PASSWORD'] ?? '',
        'encryption' => $_ENV['MAIL_ENCRYPTION'] ?? 'tls',
        'from' => [
            'address' => $_ENV['MAIL_FROM_ADDRESS'] ?? 'noreply@malarz.trzebnica.pl',
            'name' => $_ENV['MAIL_FROM_NAME'] ?? 'Malarz Trzebnica',
        ],
        'to' => $_ENV['MAIL_TO_ADDRESS'] ?? 'kontakt@malarz.trzebnica.pl',
    ],

    // Ustawienia bezpieczeństwa
    'security' => [
        'csrf_token_name' => 'csrf_token',
        'session_name' => 'malarz_trzebnica_session',
        'rate_limit' => [
            'enabled' => true,
            'max_attempts' => 5,
            'decay_minutes' => 1,
        ],
    ],

    // Ustawienia galerii
    'gallery' => [
        'upload_path' => __DIR__ . '/../uploads/gallery/',
        'max_file_size' => 5242880, // 5MB
        'allowed_types' => ['image/jpeg', 'image/png', 'image/webp'],
        'thumbnail_width' => 400,
        'thumbnail_height' => 300,
    ],

    // Cache
    'cache' => [
        'enabled' => true,
        'driver' => 'file',
        'path' => __DIR__ . '/../../cache/',
        'ttl' => 3600, // 1 hour
    ],
];

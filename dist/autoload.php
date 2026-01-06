<?php

declare(strict_types=1);

/**
 * PSR-4 Autoloader dla Malarz Trzebnica
 * 
 * @package MalarzTrzebnica
 */

spl_autoload_register(function ($class) {
    // Podstawowy namespace aplikacji
    $prefix = 'App\\';
    
    // Bazowy katalog dla namespace
    $base_dir = __DIR__ . '/app/';
    
    // Czy klasa używa namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Nie, przejdź do następnego zarejestrowanego autoloadera
        return;
    }
    
    // Pobierz względną nazwę klasy
    $relative_class = substr($class, $len);
    
    // Zamień namespace na separator katalogów i dodaj .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    // Jeśli plik istnieje, załaduj go
    if (file_exists($file)) {
        require $file;
    }
});

// Załaduj Composer autoloader (jeśli istnieje)
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require __DIR__ . '/../vendor/autoload.php';
}

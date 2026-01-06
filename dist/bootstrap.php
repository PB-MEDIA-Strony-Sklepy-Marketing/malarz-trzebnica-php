<?php
declare(strict_types=1);

/**
 * Bootstrap aplikacji Malarz Trzebnica
 * Inicjalizuje aplikację i uruchamia routing
 */

// Start session
session_start();

// Load autoloader
require __DIR__ . '/autoload.php';

// Load configuration
$config = require __DIR__ . '/config/config.php';

// Set timezone
date_default_timezone_set($config['app']['timezone']);

// Error handling (tylko development)
if ($config['app']['debug']) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(0);
}

// Initialize router
$router = new \App\Core\Router();

// Load routes
$routes = require __DIR__ . '/config/routes.php';
$router->loadRoutes($routes);

// Dispatch request
try {
    $router->dispatch();
} catch (\Exception $e) {
    if ($config['app']['debug']) {
        echo "<h1>Error</h1>";
        echo "<pre>" . $e->getMessage() . "</pre>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    } else {
        http_response_code(500);
        echo "Internal Server Error";
    }
}

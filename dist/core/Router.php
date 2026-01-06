<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Router - System routingu dla Malarz Trzebnica
 * 
 * Obsługuje mapowanie URL-i na kontrolery i akcje.
 * 
 * @package App\Core
 */
class Router
{
    private array $routes = [];
    
    /**
     * Dodaje trasę GET
     */
    public function get(string $path, string $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }
    
    /**
     * Dodaje trasę POST
     */
    public function post(string $path, string $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }
    
    /**
     * Dodaje trasę do rejestru
     */
    private function addRoute(string $method, string $path, string $handler): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler,
        ];
    }
    
    /**
     * Ładuje trasy z pliku konfiguracyjnego
     */
    public function loadRoutes(array $routes): void
    {
        foreach ($routes as $route) {
            [$method, $path, $handler] = $route;
            $this->addRoute($method, $path, $handler);
        }
    }
    
    /**
     * Dopasowuje obecny request do trasy
     */
    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $this->matchPath($route['path'], $path)) {
                $this->callHandler($route['handler']);
                return;
            }
        }
        
        // 404 Not Found
        http_response_code(404);
        echo "404 - Strona nie znaleziona";
    }
    
    private function matchPath(string $routePath, string $requestPath): bool
    {
        return $routePath === $requestPath;
    }
    
    private function callHandler(string $handler): void
    {
        [$controllerName, $method] = explode('@', $handler);
        $controllerClass = "App\\Controllers\\{$controllerName}";
        
        if (!class_exists($controllerClass)) {
            throw new \Exception("Controller {$controllerClass} not found");
        }
        
        $controller = new $controllerClass();
        
        if (!method_exists($controller, $method)) {
            throw new \Exception("Method {$method} not found in {$controllerClass}");
        }
        
        $controller->$method();
    }
}

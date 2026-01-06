<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Bazowy Controller dla Malarz Trzebnica
 * 
 * @package App\Core
 */
abstract class Controller
{
    protected function render(string $view, array $data = []): void
    {
        extract($data);
        
        $viewFile = __DIR__ . "/../app/Views/{$view}.php";
        
        if (!file_exists($viewFile)) {
            throw new \Exception("View {$view} not found");
        }
        
        require $viewFile;
    }
    
    protected function json(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    
    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }
}

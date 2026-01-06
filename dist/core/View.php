<?php
declare(strict_types=1);

namespace App\Core;

class View
{
    private string $layout = 'layouts/default';
    private array $sections = [];
    private string $currentSection = '';
    
    public function render(string $view, array $data = []): void
    {
        extract($data);
        ob_start();
        require __DIR__ . "/../app/Views/{$view}.php";
        $content = ob_get_clean();
        
        if ($this->layout) {
            require __DIR__ . "/../app/Views/{$this->layout}.php";
        } else {
            echo $content;
        }
    }
}

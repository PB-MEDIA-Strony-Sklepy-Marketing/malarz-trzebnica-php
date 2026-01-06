<?php
declare(strict_types=1);

namespace App\Core;

class Security
{
    public static function generateCsrfToken(): string
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    public static function validateCsrfToken(string $token): bool
    {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    public static function checkRateLimit(string $identifier, int $maxAttempts, int $decayMinutes): bool
    {
        $key = "rate_limit_{$identifier}";
        $attempts = $_SESSION[$key]['attempts'] ?? 0;
        $firstAttempt = $_SESSION[$key]['first_attempt'] ?? time();
        
        if (time() - $firstAttempt > $decayMinutes * 60) {
            $_SESSION[$key] = ['attempts' => 1, 'first_attempt' => time()];
            return true;
        }
        
        if ($attempts >= $maxAttempts) {
            return false;
        }
        
        $_SESSION[$key]['attempts'] = $attempts + 1;
        return true;
    }
}

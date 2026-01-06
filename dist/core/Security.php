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
    
    /**
     * Backward-compatible wrapper (legacy signature).
     * Prefer calling checkRateLimitForEndpoint() to scope limits per endpoint.
     */
    public static function checkRateLimit(string $identifier, int $maxAttempts, int $decayMinutes): bool
    {
        return self::checkRateLimitForEndpoint('global', $identifier, $maxAttempts, $decayMinutes);
    }

    /**
     * Endpoint-scoped rate limiter.
     *
     * Uses APCu (shared, per-server) when available; otherwise falls back to $_SESSION.
     * Note: For multi-server deployments, replace APCu with a shared store (e.g., Redis/DB).
     */
    public static function checkRateLimitForEndpoint(string $endpoint, string $identifier, int $maxAttempts, int $decayMinutes): bool
    {
        $endpoint = preg_replace('/[^a-zA-Z0-9_\-:.]/', '_', $endpoint);
        $identifier = preg_replace('/[^a-zA-Z0-9_\-:.]/', '_', $identifier);

        $key = "rate_limit_{$endpoint}_{$identifier}";
        $ttl = max(1, $decayMinutes) * 60;
        $now = time();

        $data = self::rateLimitGet($key);
        $attempts = (int)($data['attempts'] ?? 0);
        $firstAttempt = (int)($data['first_attempt'] ?? $now);

        if (($now - $firstAttempt) > $ttl) {
            self::rateLimitSet($key, ['attempts' => 1, 'first_attempt' => $now], $ttl);
            return true;
        }

        if ($attempts >= $maxAttempts) {
            return false;
        }

        self::rateLimitSet($key, ['attempts' => $attempts + 1, 'first_attempt' => $firstAttempt], $ttl);
        return true;
    }

    /**
     * @return array<string, int>|null
     */
    private static function rateLimitGet(string $key): ?array
    {
        if (function_exists('apcu_fetch') && ini_get('apc.enabled')) {
            $success = false;
            $value = apcu_fetch($key, $success);
            return ($success && is_array($value)) ? $value : null;
        }

        return $_SESSION[$key] ?? null;
    }

    /**
     * @param array<string, int> $value
     */
    private static function rateLimitSet(string $key, array $value, int $ttlSeconds): void
    {
        if (function_exists('apcu_store') && ini_get('apc.enabled')) {
            apcu_store($key, $value, $ttlSeconds);
            return;
        }

        // Best-effort TTL handling for session fallback (cleared when window expires in check method).
        $_SESSION[$key] = $value;
    }
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

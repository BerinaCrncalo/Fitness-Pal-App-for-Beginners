<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware {
    public static function authenticate() {
        $headers = [];

        // Get all HTTP headers
        if (function_exists('getallheaders')) {
            $headers = getallheaders();
        } else {
            foreach ($_SERVER as $name => $value) {
                if (str_starts_with($name, 'HTTP_')) {
                    $key = str_replace('_', '-', substr($name, 5));
                    $headers[$key] = $value;
                }
            }
        }

        // Check for Authorization header
        if (!isset($headers['Authorization'])) {
            Flight::halt(401, "Missing Authorization header");
        }

        $authHeader = $headers['Authorization'];

        if (!str_starts_with($authHeader, 'Bearer ')) {
            Flight::halt(401, "Invalid Authorization format");
        }

        // Extract token
        $token = str_replace('Bearer ', '', $authHeader);

        try {
            // Decode JWT
            $decoded = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));

            // Attach user data to Flight for use in routes
            Flight::set('user', (array) $decoded->user);
        } catch (Exception $e) {
            Flight::halt(401, "Invalid token: " . $e->getMessage());
        }
    }

    public static function authorizeRole($requiredRole) {
        self::authenticate();
        $user = Flight::get('user');

        if (!isset($user['role']) || $user['role'] !== $requiredRole) {
            Flight::halt(403, "Access denied. Role '{$requiredRole}' required.");
        }
    }

    public static function authorizeRoles(array $roles) {
        self::authenticate();
        $user = Flight::get('user');

        if (!isset($user['role']) || !in_array($user['role'], $roles)) {
            Flight::halt(403, "Access denied. Requires one of the following roles: " . implode(', ', $roles));
        }
    }
}

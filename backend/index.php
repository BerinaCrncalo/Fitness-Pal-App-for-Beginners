<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Prevent running in CLI mode (optional, keep if needed)
if (php_sapi_name() === 'cli') {
    return;
}

require_once __DIR__ . '/../vendor/autoload.php';

// CORS headers - adjust origin as needed
header("Access-Control-Allow-Origin:  fitness-app-u6kxs.ondigitalocean.app");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight OPTIONS request early
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Services
require_once __DIR__ . '/../rest/services/AuthService.php';
require_once __DIR__ . '/../rest/services/UserService.php';
require_once __DIR__ . '/../rest/services/VehicleService.php';
require_once __DIR__ . '/../rest/services/StationService.php';
require_once __DIR__ . '/../rest/services/InspectionService.php';

// Register services with Flight
Flight::register('auth_service', 'AuthService');
Flight::register('user_service', 'UserService');
Flight::register('vehicle_service', 'VehicleService');
Flight::register('station_service', 'StationService');
Flight::register('inspection_service', 'InspectionService');

// Inline JWT Authentication Middleware
Flight::route('/*', function () {
    // Public routes that do not require auth
    $public_routes = [
        '/auth/login',
        '/auth/register',
        '/docs',
        '/docs/',
        '/docs/index.html',
        '/docs/swagger.php',
        '/public/v1/docs',
        '/public/v1/docs/',
        '/public/v1/docs/swagger.php',
        '/public/v1/docs/index.html'
    ];

    $request_url = Flight::request()->url;

    foreach ($public_routes as $route) {
        if (strpos($request_url, $route) === 0) {
            return true; // public route, no auth needed
        }
    }

    // Get Authorization header
    $headers = getallheaders();
    if (empty($headers['Authorization'])) {
        Flight::json(['message' => 'Authorization is missing'], 403);
        return false;
    }

    $authHeader = $headers['Authorization'];

    // Expect "Bearer <token>" format, so extract token
    if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        $jwt = $matches[1];
    } else {
        Flight::json(['message' => 'Authorization header format is invalid'], 403);
        return false;
    }

    try {
        // Replace Config::JWT_SECRET() with your actual secret or config
        $secretKey = Config::JWT_SECRET();

        $decoded = (array)JWT::decode($jwt, new Key($secretKey, 'HS256'));

        // Save user info into Flight context for further use
        Flight::set('user', $decoded);

        return true;
    } catch (Exception $e) {
        Flight::json(['message' => 'Authorization token is not valid', 'error' => $e->getMessage()], 403);
        return false;
    }
});

// Route files
require_once __DIR__ . '/../rest/routes/AuthRoutes.php';
require_once __DIR__ . '/../rest/routes/UserRoutes.php';
require_once __DIR__ . '/../rest/routes/VehicleRoutes.php';
require_once __DIR__ . '/../rest/routes/StationRoutes.php';
require_once __DIR__ . '/../rest/routes/InspectionRoutes.php';

// OpenAPI docs route (optional)
Flight::route('GET /docs.json', function () {
    $openapi = \OpenApi\scan(__DIR__ . '/../rest/routes');
    header('Content-Type: application/json');
    echo $openapi->toJson();
});

// Start the Flight framework
Flight::start();

?>

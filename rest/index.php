<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
require "services/ChallengeService.php";
require "services/MealService.php";
require "services/UserService.php";
require "services/WeightService.php";
require "services/WorkoutplanService.php";
require "services/WorkoutService.php";


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

Flight::register("challenge_service", "ChallengeService");
Flight::register("meal_service", "MealService");
Flight::register("weight_service", "WeightService");
Flight::register("workoutplan_service", "WorkoutplanService");
Flight::register("workout_service", "WorkoutService");



require_once 'routes/ChallengeRoutes.php';
require_once 'routes/MealRoutes.php';
require_once 'routes/UserRoutes.php';
require_once 'routes/WeightRoutes.php';
require_once 'routes/WorkoutplanRoutes.php';
require_once 'routes/WorkoutRoutes.php';



// middleware method for login
Flight::route('/*', function () {
  $path = Flight::request()->url;
  if ($path == '/login' || $path == '/docs.json' || $path == '/test/*') {
      return true;
  }

  $headers = getallheaders();
  if (@!$headers['Authorization']) {
      Flight::json(["message" => "Authorization is missing"], 403);
      return false;
  } else {
      try {
          $decoded = (array)JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
          Flight::set('user', $decoded);
          return true;
      } catch (\Exception $e) {
          Flight::json(["message" => "Authorization token is not valid"], 403);
          return false;
      }
  }
});
  
Flight::route('GET /docs.json', function(){
    $openapi = \OpenApi\scan('routes');  
    header('Content-Type: application/json');
    echo $openapi->toJson();
});



Flight::start();

?>
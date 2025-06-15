<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * @OA\Post(
 *     path="/login", 
 *     description="Login with email and password to receive a JWT token",
 *     tags={"login"},
 *     @OA\RequestBody(
 *         description="User login credentials",
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 required={"email", "password"},
 *                 @OA\Property(property="email", type="string", example="demo@gmail.com", description="User email"),
 *                 @OA\Property(property="password", type="string", example="12345", description="User password")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfully logged in, returns JWT token"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized - wrong credentials"
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error"
 *     )
 * )
 */
Flight::route('POST /login', function(){
    try {
        $login = Flight::request()->data->getData();

        if (!isset($login['email']) || !isset($login['password'])) {
            Flight::json(["message" => "Email and password are required."], 400);
            return;
        }

        $users = Flight::userDao()->get_user_by_email($login['email']);

        if (empty($users)) {
            Flight::json(["message" => "User doesn't exist."], 401);
            return;
        }

        $user = $users[0];

        if ($user['password'] !== md5($login['password'])) {
            Flight::json(["message" => "Wrong password."], 401);
            return;
        }

        unset($user['password']); // Never expose the password hash
        $user['is_admin'] = false; 
        $jwt = JWT::encode($user, Config::JWT_SECRET(), 'HS256');

        Flight::json(['token' => $jwt]);
        
    } catch (Exception $e) {
        Flight::json(["message" => "Login failed", "error" => $e->getMessage()], 500);
    }
});
?>

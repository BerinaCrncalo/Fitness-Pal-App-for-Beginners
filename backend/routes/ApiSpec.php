<?php
/**
 * @OA\Info(
 *     title="Fitness App API",
 *     version="1.0",
 *     description="Backend API for the fitness mobile app. Includes authentication, meals, weights, and challenges.",
 *     @OA\Contact(email="support@fitnessapp.local", name="Fitness App Support")
 * )
 * 
 * @OA\OpenApi(
 *     @OA\Server(
 *         url="http://localhost/fitness-app-api/rest",
 *         description="Local development server"
 *     )
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="ApiKeyAuth",
 *     type="apiKey",
 *     in="header",
 *     name="Authorization"
 * )
 */
?>

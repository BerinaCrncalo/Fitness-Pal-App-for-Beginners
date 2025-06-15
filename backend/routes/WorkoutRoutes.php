<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * @OA\Get(
 *     path="/workouts",
 *     tags={"workouts"},
 *     security={{"ApiKeyAuth": {}}},
 *     summary="Get all workouts",
 *     @OA\Response(response=200, description="List of workouts")
 * )
 */
Flight::route("GET /workouts", function(){
    AuthMiddleware::authenticate();
    Flight::json(Flight::workout_service()->get_all());
});

/**
 * @OA\Get(
 *     path="/workout/{id}",
 *     tags={"workouts"},
 *     security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", required=true, example=1, description="Workout ID"),
 *     @OA\Response(response=200, description="Workout by ID")
 * )
 */
Flight::route("GET /workout/@id", function($id){
    AuthMiddleware::authenticate();
    Flight::json(Flight::workout_service()->get_by_id($id));
});

/**
 * @OA\Delete(
 *     path="/workout/{id}",
 *     tags={"workouts"},
 *     security={{"ApiKeyAuth": {}}},
 *     description="Delete a workout",
 *     @OA\Parameter(in="path", name="id", required=true, example=1, description="Workout ID"),
 *     @OA\Response(response=200, description="Workout deleted"),
 *     @OA\Response(response=500, description="Error occurred")
 * )
 */
Flight::route("DELETE /workout/@id", function($id){
    AuthMiddleware::authenticate();
    Flight::workout_service()->delete($id);
    Flight::json(['message' => "Workout deleted successfully"]);
});

/**
 * @OA\Post(
 *     path="/workout",
 *     tags={"workouts"},
 *     security={{"ApiKeyAuth": {}}},
 *     description="Add a new workout",
 *     @OA\RequestBody(required=true,
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="name", type="string", example="Push Day", description="Workout name"),
 *                 @OA\Property(property="description", type="string", example="Chest, shoulders, triceps", description="Workout details"),
 *                 @OA\Property(property="difficulty", type="string", example="Intermediate", description="Difficulty level")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=200, description="Workout added"),
 *     @OA\Response(response=500, description="Error occurred")
 * )
 */
Flight::route("POST /workout", function(){
    AuthMiddleware::authenticate();
    $request = Flight::request()->data->getData();
    $workout = Flight::workout_service()->add($request);
    Flight::json(['message' => "Workout added successfully", 'data' => $workout]);
});

/**
 * @OA\Put(
 *     path="/workout/{id}",
 *     tags={"workouts"},
 *     security={{"ApiKeyAuth": {}}},
 *     description="Update workout details",
 *     @OA\Parameter(in="path", name="id", required=true, example=1, description="Workout ID"),
 *     @OA\RequestBody(required=true,
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="name", type="string", example="Push Day", description="Workout name"),
 *                 @OA\Property(property="description", type="string", example="Chest and triceps", description="Workout description"),
 *                 @OA\Property(property="difficulty", type="string", example="Advanced", description="Workout difficulty")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=200, description="Workout updated"),
 *     @OA\Response(response=500, description="Error occurred")
 * )
 */
Flight::route("PUT /workout/@id", function($id){
    AuthMiddleware::authenticate();
    $workout = Flight::request()->data->getData();
    $updated = Flight::workout_service()->update($workout, $id);
    Flight::json(['message' => "Workout updated successfully", 'data' => $updated]);
});

?>
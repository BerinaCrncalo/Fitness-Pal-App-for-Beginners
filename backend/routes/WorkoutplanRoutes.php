<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * @OA\Get(
 *     path="/workoutplan",
 *     tags={"workoutplans"},
 *     security={{"ApiKeyAuth": {}}},
 *     summary="Return all workout plans",
 *     @OA\Response(response=200, description="List of workout plans")
 * )
 */
Flight::route("GET /workoutplan", function() {
    AuthMiddleware::authenticate();
    Flight::json(Flight::workoutplan_service()->get_all());
});

/**
 * @OA\Get(
 *     path="/workoutplan/{id}",
 *     tags={"workoutplans"},
 *     security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", required=true, example=1, description="Workout plan ID"),
 *     @OA\Response(response=200, description="Workout plan by ID")
 * )
 */
Flight::route("GET /workoutplan/@id", function($id) {
    AuthMiddleware::authenticate();
    Flight::json(Flight::workoutplan_service()->get_by_id($id));
});

/**
 * @OA\Delete(
 *     path="/workoutplan/{id}",
 *     tags={"workoutplans"},
 *     security={{"ApiKeyAuth": {}}},
 *     description="Delete workout plan",
 *     @OA\Parameter(in="path", name="id", required=true, example=1, description="Workout plan ID"),
 *     @OA\Response(response=200, description="Workout plan deleted"),
 *     @OA\Response(response=500, description="Error occurred")
 * )
 */
Flight::route("DELETE /workoutplan/@id", function($id) {
    AuthMiddleware::authenticate();
    Flight::workoutplan_service()->delete($id);
    Flight::json(['message' => "Workout plan deleted successfully"]);
});

/**
 * @OA\Post(
 *     path="/workoutplan",
 *     tags={"workoutplans"},
 *     security={{"ApiKeyAuth": {}}},
 *     description="Add a new workout plan",
 *     @OA\RequestBody(
 *         description="Add new workout plan",
 *         required=true,
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="title", type="string", example="Summer Shred", description="Title of the plan"),
 *                 @OA\Property(property="description", type="string", example="4-week high intensity workout", description="Plan description"),
 *                 @OA\Property(property="duration", type="integer", example=28, description="Duration in days"),
 *                 @OA\Property(property="level", type="string", example="Intermediate", description="Difficulty level")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=200, description="Workout plan added"),
 *     @OA\Response(response=500, description="Error occurred")
 * )
 */
Flight::route("POST /workoutplan", function() {
    AuthMiddleware::authenticate();
    $request = Flight::request()->data->getData();
    $added = Flight::workoutplan_service()->add($request);
    Flight::json([
        'message' => "Workout plan added successfully",
        'data' => $added
    ]);
});

/**
 * @OA\Put(
 *     path="/workoutplan/{id}",
 *     tags={"workoutplans"},
 *     security={{"ApiKeyAuth": {}}},
 *     description="Update workout plan",
 *     @OA\Parameter(in="path", name="id", required=true, example=1, description="Workout plan ID"),
 *     @OA\RequestBody(
 *         description="Workout plan info",
 *         required=true,
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="title", type="string", example="Updated Plan", description="Plan title"),
 *                 @OA\Property(property="description", type="string", example="Updated description", description="Plan details"),
 *                 @OA\Property(property="duration", type="integer", example=30, description="Plan duration"),
 *                 @OA\Property(property="level", type="string", example="Advanced", description="Plan level")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=200, description="Workout plan updated"),
 *     @OA\Response(response=500, description="Error occurred")
 * )
 */
Flight::route("PUT /workoutplan/@id", function($id) {
    AuthMiddleware::authenticate();
    $data = Flight::request()->data->getData();
    $updated = Flight::workoutplan_service()->update($data, $id);
    Flight::json([
        'message' => "Workout plan updated successfully",
        'data' => $updated
    ]);
});


?>
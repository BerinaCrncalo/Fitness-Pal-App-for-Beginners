<?php

/**
 * @OA\Get(
 *     path="/weights",
 *     tags={"weights"},
 *     security={{"ApiKeyAuth": {}}},
 *     summary="Return all weight entries",
 *     @OA\Response(response=200, description="List of weight entries")
 * )
 */
Flight::route("GET /weights", function(){
    AuthMiddleware::authenticate();
    Flight::json(Flight::weight_service()->get_all());
});

/**
 * @OA\Get(
 *     path="/weight/{id}",
 *     tags={"weights"},
 *     security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Weight entry ID"),
 *     @OA\Response(response=200, description="Weight entry by ID")
 * )
 */
Flight::route("GET /weight/@id", function($id){
    AuthMiddleware::authenticate();
    Flight::json(Flight::weight_service()->get_by_id($id));
});

/**
 * @OA\Delete(
 *     path="/weight/{id}",
 *     tags={"weights"},
 *     security={{"ApiKeyAuth": {}}},
 *     description="Delete weight entry",
 *     @OA\Parameter(in="path", name="id", example=1, description="Weight entry ID"),
 *     @OA\Response(response=200, description="Weight entry deleted"),
 *     @OA\Response(response=500, description="Error occurred")
 * )
 */
Flight::route("DELETE /weight/@id", function($id){
    AuthMiddleware::authenticate();
    Flight::weight_service()->delete($id);
    Flight::json(['message' => "Weight entry deleted successfully"]);
});

/**
 * @OA\Post(
 *     path="/weight",
 *     tags={"weights"},
 *     security={{"ApiKeyAuth": {}}},
 *     description="Add a new weight entry",
 *     @OA\RequestBody(
 *         description="Add new weight entry",
 *         required=true,
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="user_id", type="integer", example=1, description="User ID"),
 *                 @OA\Property(property="weight_kg", type="number", format="float", example=75.5, description="Weight in kilograms"),
 *                 @OA\Property(property="date", type="string", format="date", example="2025-06-15", description="Date of entry")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=200, description="Weight entry added"),
 *     @OA\Response(response=500, description="Error occurred")
 * )
 */
Flight::route("POST /weight", function(){
    AuthMiddleware::authenticate();
    $request = Flight::request()->data->getData();
    $added = Flight::weight_service()->add($request);
    Flight::json([
        'message' => "Weight entry added successfully",
        'data' => $added
    ]);
});

/**
 * @OA\Put(
 *     path="/weight/{id}",
 *     tags={"weights"},
 *     security={{"ApiKeyAuth": {}}},
 *     description="Update a weight entry",
 *     @OA\Parameter(in="path", name="id", example=1, description="Weight entry ID"),
 *     @OA\RequestBody(
 *         description="Weight entry data",
 *         required=true,
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="weight_kg", type="number", format="float", example=78.2, description="Updated weight"),
 *                 @OA\Property(property="date", type="string", format="date", example="2025-06-14", description="Updated date")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=200, description="Weight entry updated"),
 *     @OA\Response(response=500, description="Error occurred")
 * )
 */
Flight::route("PUT /weight/@id", function($id){
    AuthMiddleware::authenticate();
    $data = Flight::request()->data->getData();
    $updated = Flight::weight_service()->update($data, $id);
    Flight::json([
        'message' => "Weight entry updated successfully",
        'data' => $updated
    ]);
});

?>
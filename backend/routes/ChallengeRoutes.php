<?php

/**
 * @OA\Get(path="/challenges", tags={"challenges"}, security={{"ApiKeyAuth": {}}},
 *     summary="Return all challenges",
 *     @OA\Response(response=200, description="List of challenges")
 * )
 */
Flight::route("GET /challenges", function(){
    Flight::json(Flight::challenge_service()->get_all());
});

/**
 * @OA\Get(path="/challenge/{id}", tags={"challenges"}, security={{"ApiKeyAuth": {}}},
 *     @OA\Parameter(in="path", name="id", example=1, description="Challenge ID"),
 *     @OA\Response(response=200, description="Get challenge by ID")
 * )
 */
Flight::route("GET /challenge/@id", function($id){
    Flight::json(Flight::challenge_service()->get_by_id($id));
});

/**
 * @OA\Delete(
 *     path="/challenge/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Delete challenge",
 *     tags={"challenges"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Challenge ID"),
 *     @OA\Response(response=200, description="Challenge deleted"),
 *     @OA\Response(response=500, description="Error")
 * )
 */
Flight::route("DELETE /challenge/@id", function($id){
    Flight::challenge_service()->delete($id);
    Flight::json(['message' => "Challenge deleted successfully"]);
});

/**
 * @OA\Post(
 *     path="/challenge", security={{"ApiKeyAuth": {}}},
 *     description="Add new challenge",
 *     tags={"challenges"},
 *     @OA\RequestBody(description="Add new challenge", required=true,
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="title", type="string", example="10K Steps Challenge", description="Challenge title"),
 *                 @OA\Property(property="description", type="string", example="Walk 10,000 steps daily for 30 days", description="Challenge description"),
 *                 @OA\Property(property="start_date", type="string", format="date", example="2025-06-01", description="Challenge start date"),
 *                 @OA\Property(property="end_date", type="string", format="date", example="2025-06-30", description="Challenge end date")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=200, description="Challenge added"),
 *     @OA\Response(response=500, description="Error")
 * )
 */
Flight::route("POST /challenge", function(){
    $request = Flight::request()->data->getData();
    Flight::json([
        'message' => "Challenge added successfully",
        'data' => Flight::challenge_service()->add($request)
    ]);
});

/**
 * @OA\Put(
 *     path="/challenge/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Edit challenge",
 *     tags={"challenges"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Challenge ID"),
 *     @OA\RequestBody(description="Challenge data", required=true,
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="title", type="string", example="10K Steps Challenge", description="Challenge title"),
 *                 @OA\Property(property="description", type="string", example="Walk 10,000 steps daily for 30 days", description="Challenge description"),
 *                 @OA\Property(property="start_date", type="string", format="date", example="2025-06-01", description="Challenge start date"),
 *                 @OA\Property(property="end_date", type="string", format="date", example="2025-06-30", description="Challenge end date")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=200, description="Challenge updated"),
 *     @OA\Response(response=500, description="Error")
 * )
 */
Flight::route("PUT /challenge/@id", function($id){
    $challenge = Flight::request()->data->getData();
    Flight::json([
        'message' => "Challenge updated successfully",
        'data' => Flight::challenge_service()->update($challenge, $id)
    ]);
});

?>

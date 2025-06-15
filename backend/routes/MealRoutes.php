<?php

/**
 * @OA\Get(path="/meals", tags={"meals"}, security={{"ApiKeyAuth": {}}},
 *         summary="Return all meals from the API",
 *         @OA\Response(response=200, description="List of meals")
 * )
 */
Flight::route("GET /meals", function(){
    Flight::json(Flight::meal_service()->get_all());
});

/**
 * @OA\Get(path="/meal/{id}", tags={"meals"}, security={{"ApiKeyAuth": {}}},
 *         @OA\Parameter(in="path", name="id", example=1, description="Meal ID"),
 *         @OA\Response(response=200, description="Get meal by ID")
 * )
 */
Flight::route("GET /meal/@id", function($id){
    Flight::json(Flight::meal_service()->get_by_id($id));
});

/**
 * @OA\Delete(
 *     path="/meal/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Delete meal",
 *     tags={"meals"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Meal ID"),
 *     @OA\Response(response=200, description="Meal deleted"),
 *     @OA\Response(response=500, description="Error")
 * )
 */
Flight::route("DELETE /meal/@id", function($id){
    Flight::meal_service()->delete($id);
    Flight::json(['message' => "Meal deleted successfully"]);
});

/**
 * @OA\Post(
 *     path="/meal", security={{"ApiKeyAuth": {}}},
 *     description="Add new meal",
 *     tags={"meals"},
 *     @OA\RequestBody(description="Meal data", required=true,
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="name", type="string", example="Chicken Salad", description="Name of the meal"),
 *                 @OA\Property(property="calories", type="integer", example=450, description="Calories in meal"),
 *                 @OA\Property(property="protein", type="integer", example=35, description="Protein content in grams"),
 *                 @OA\Property(property="carbs", type="integer", example=40, description="Carbs content in grams"),
 *                 @OA\Property(property="fat", type="integer", example=15, description="Fat content in grams")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=200, description="Meal added"),
 *     @OA\Response(response=500, description="Error")
 * )
 */
Flight::route("POST /meal", function(){
    $request = Flight::request()->data->getData();
    Flight::json([
        'message' => "Meal added successfully",
        'data' => Flight::meal_service()->add($request)
    ]);
});

/**
 * @OA\Put(
 *     path="/meal/{id}", security={{"ApiKeyAuth": {}}},
 *     description="Edit a meal",
 *     tags={"meals"},
 *     @OA\Parameter(in="path", name="id", example=1, description="Meal ID"),
 *     @OA\RequestBody(description="Meal data", required=true,
 *         @OA\MediaType(mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="name", type="string", example="Chicken Salad", description="Name of the meal"),
 *                 @OA\Property(property="calories", type="integer", example=450, description="Calories in meal"),
 *                 @OA\Property(property="protein", type="integer", example=35, description="Protein content in grams"),
 *                 @OA\Property(property="carbs", type="integer", example=40, description="Carbs content in grams"),
 *                 @OA\Property(property="fat", type="integer", example=15, description="Fat content in grams")
 *             )
 *         )
 *     ),
 *     @OA\Response(response=200, description="Meal updated"),
 *     @OA\Response(response=500, description="Error")
 * )
 */
Flight::route("PUT /meal/@id", function($id){
    $meal = Flight::request()->data->getData();
    Flight::json([
        'message' => "Meal edited successfully",
        'data' => Flight::meal_service()->update($meal, $id)
    ]);
});

?>

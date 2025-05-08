<?php
/**
 * @OA\Get(
 *     path="/category",
 *     tags={"category"},
 *     summary="Get all categories",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all categories"
 *     )
 * )
 */
Flight::route("GET /category", function() {
    Flight::json(Flight::category_service()->get_all());
}); 
/**
 * @OA\Get(
 *     path="/category/{id}",
 *     tags={"category"},
 *     summary="Get category by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the category",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the category with the given ID"
 *     )
 * )
 */
Flight::route("GET /category/@id", function($id) {
    Flight::json(Flight::category_service()->getByCategoryId($id));
}); 
/**
 * @OA\Delete(
 *     path="/category/{id}",
 *     tags={"category"},
 *     summary="Delete a category by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Category ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category deleted successfully"
 *     )
 * )
 */
Flight::route("DELETE /category/@id", function($id) {
    Flight::category_service()->delete($id);
    Flight::json(['message' => "Category has been added successfully"]);
});
/**
 * @OA\Post(
 *     path="/category",
 *     tags={"category"},
 *     summary="Add a new category",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name"},
 *             @OA\Property(property="name", type="string", example="Technology"),
 *             @OA\Property(property="description", type="string", example="All about tech and innovations")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category added successfully"
 *     )
 * )
 */
Flight::route("POST /category", function() {
    $request = Flight::request()->data->getData();
    Flight::json([
        'message' => "Category added successfully",
        'data' => Flight::category_service()->add($request)
    ]);
});
/**
 * @OA\Patch(
 *     path="/category/{id}",
 *     tags={"category"},
 *     summary="Update a category by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Category ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Category Name"),
 *             @OA\Property(property="description", type="string", example="Updated description for the category")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category updated successfully"
 *     )
 * )
 */
Flight::route("PATCH /category/@id", function($id) {
    $blog = Flight::request()->data->getData();
    Flight::json([
        'message' => "Category eddited successfully",
        'data' => Flight::category_service()->update($blog, $id, 'id')
    ]);
});
?>
<?php
/**
 * @OA\Get(
 *     path="/users",
 *     tags={"users"},
 *     summary="Get all users",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all users"
 *     )
 * )
 */
Flight::route("GET /users", function() {
    Flight::json(Flight::user_service()->get_all());
}); 
/**
 * @OA\Get(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Get user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the user",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the user with the given ID"
 *     )
 * )
 */
Flight::route("GET /users/@id", function($id) {
    Flight::json(Flight::user_service()->getUserById($id));
}); 

/**
 * @OA\Delete(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Delete a user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User deleted successfully"
 *     )
 * )
 */
Flight::route("DELETE /users/@id", function($id) {
    Flight::user_service()->delete($id);
    Flight::json(['message' => "user has been added successfully"]);
});
/**
 * @OA\Post(
 *     path="/users",
 *     tags={"users"},
 *     summary="Add a new user",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email", "password"},
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", example="john@example.com"),
 *             @OA\Property(property="password", type="string", example="secret123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User added successfully"
 *     )
 * )
 */
Flight::route("POST /users", function() {
    $request = Flight::request()->data->getData();
    Flight::json([
        'message' => "user added successfully",
        'data' => Flight::user_service()->add($request)
    ]);
});
/**
 * @OA\Patch(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Update a user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="John Smith"),
 *             @OA\Property(property="email", type="string", example="johnsmith@example.com")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User updated successfully"
 *     )
 * )
 */
Flight::route("PATCH /users/@id", function($id) {
    $user = Flight::request()->data->getData();
    Flight::json([
        'message' => "user eddited successfully",
        'data' => Flight::user_service()->update($user, $id, 'id')
    ]);
});
?>
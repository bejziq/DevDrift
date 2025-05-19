<?php
require_once __DIR__ . '/../services/UserService.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


/**
 * @OA\Get(
 *     path="/users",
 *     tags={"users"},
 *     summary="Return all users from the API.",
 *     security={
 *         {"ApiKey": {}}
 *     },
 *     @OA\Response(
 *         response=200,
 *         description="List of users."
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
     *      path="/users/add",
     *      tags={"users"},
     *      summary="Add user data to the database",
     *      @OA\Response(
     *           response=200,
     *           description="User data, or exception if patient is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="User data payload",
     *          @OA\JsonContent(
     *              required={"first_name","last_name","email"},
     *              @OA\Property(property="user_id", type="string", example="1", description="User ID"),
     *              @OA\Property(property="name", type="string", example="Some name", description="User first name"),
     *              @OA\Property(property="surname", type="string", example="Some surname", description="User last name"),
     *              @OA\Property(property="email", type="string", example="example@example.com", description="Patient email address"),
     *              @OA\Property(property="password", type="string", example="some_secret_password", description="Patient password")
     *          )
     *      )
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
 *     summary="Edit user details",
 *     description="Update user information using their ID.",
 *     tags={"users"},
 *     security={
 *         {"ApiKey": {}}
 *     },
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         description="Updated user information",
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(
 *              property="name", 
 *              type="string", 
 *              example="Demo", 
 *              description="Username"
 *             ),
 *             @OA\Property(property="email", type="string", example="demo@gmail.com", description="user email")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User has been edited successfully."
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input data."
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error."
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
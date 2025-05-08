<?php
/**
 * @OA\Get(
 *     path="/roles",
 *     tags={"roles"},
 *     summary="Get all roles",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all roles"
 *     )
 * )
 */
Flight::route("GET /roles", function() {
    Flight::json(Flight::role_service()->get_all());
}); 
/**
 * @OA\Get(
 *     path="/roles/{id}",
 *     tags={"roles"},
 *     summary="Get role by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the role",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the role with the given ID"
 *     )
 * )
 */
Flight::route("GET /roles/@id", function($id) {
    Flight::json(Flight::role_service()->getByRoleId($id));
}); 
/**
 * @OA\Delete(
 *     path="/roles/{id}",
 *     tags={"roles"},
 *     summary="Delete a role by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Role ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Role deleted successfully"
 *     )
 * )
 */
Flight::route("DELETE /roles/@id", function($id) {
    Flight::role_service()->delete($id);
    Flight::json(['message' => "role has been added successfully"]);
});
/**
 * @OA\Post(
 *     path="/roles",
 *     tags={"roles"},
 *     summary="Add a new role",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name"},
 *             @OA\Property(property="name", type="string", example="Admin")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Role added successfully"
 *     )
 * )
 */
Flight::route("POST /roles", function() {
    $request = Flight::request()->data->getData();
    Flight::json([
        'message' => "role added successfully",
        'data' => Flight::role_service()->add($request)
    ]);
});

/**
 * @OA\Patch(
 *     path="/roles/{id}",
 *     tags={"roles"},
 *     summary="Update a role by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Role ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Editor")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Role updated successfully"
 *     )
 * )
 */
Flight::route("PATCH /roles/@id", function($id) {
    $blog = Flight::request()->data->getData();
    Flight::json([
        'message' => "role eddited successfully",
        'data' => Flight::role_service()->update($blog, $id, 'id')
    ]);
});
?>
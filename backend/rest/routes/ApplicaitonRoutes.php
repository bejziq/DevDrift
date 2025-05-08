<?php
/**
 * @OA\Get(
 *     path="/applications",
 *     tags={"applications"},
 *     summary="Get all applications",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all applications"
 *     )
 * )
 */
Flight::route("GET /applications", function() {
    Flight::json(Flight::application_service()->get_all());
}); 
/**
 * @OA\Get(
 *     path="/applications/{id}",
 *     tags={"applications"},
 *     summary="Get application by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the application",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the application with the given ID"
 *     )
 * )
 */
Flight::route("GET /applications/@id", function($id) {
    Flight::json(Flight::application_service()->getByApplicationId($id));
}); 
/**
 * @OA\Delete(
 *     path="/applications/{id}",
 *     tags={"applications"},
 *     summary="Delete an application by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Application ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Application deleted successfully"
 *     )
 * )
 */
Flight::route("DELETE /applications/@id", function($id) {
    Flight::application_service()->delete($id);
    Flight::json(['message' => "Application added successfully"]);
});
/**
 * @OA\Post(
 *     path="/applications",
 *     tags={"applications"},
 *     summary="Add a new application",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email"},
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", example="john@example.com"),
 *             @OA\Property(property="position", type="string", example="Software Engineer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Application added successfully"
 *     )
 * )
 */
Flight::route("POST /applications", function() {
    $request = Flight::request()->data->getData();
    Flight::json([
        'message' => "Application added successfully",
        'data' => Flight::application_service()->add($request)
    ]);
});

/**
 * @OA\Patch(
 *     path="/applications/{id}",
 *     tags={"applications"},
 *     summary="Update an existing application by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Application ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Jane Doe"),
 *             @OA\Property(property="email", type="string", example="jane@example.com"),
 *             @OA\Property(property="position", type="string", example="DevOps Engineer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Application updated successfully"
 *     )
 * )
 */
Flight::route("PATCH /applications/@id", function($id) {
    $application = Flight::request()->data->getData();
    Flight::json([
        'message' => "Application eddited successfully",
        'data' => Flight::application_service()->update($application, $id, 'id')
    ]);
});


<?php
/**
 * @OA\Get(
 *     path="/contacts",
 *     tags={"contacts"},
 *     summary="Get all contacts",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all contacts"
 *     )
 * )
 */
Flight::route("GET /contacts", function() {
    Flight::json(Flight::contact_service()->get_all());
}); 
/**
 * @OA\Get(
 *     path="/contacts/{id}",
 *     tags={"contacts"},
 *     summary="Get contact by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the contact",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the contact with the given ID"
 *     )
 * )
 */
Flight::route("GET /contacts/@id", function($id) {
    Flight::json(Flight::contact_service()->getByContactId($id));
}); 
/**
 * @OA\Delete(
 *     path="/contacts/{id}",
 *     tags={"contacts"},
 *     summary="Delete a contact by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Contact ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Contact deleted successfully"
 *     )
 * )
 */
Flight::route("DELETE /contacts/@id", function($id) {
    Flight::contact_service()->delete($id);
    Flight::json(['message' => "contact has been added successfully"]);
});

/**
 * @OA\Post(
 *     path="/contacts",
 *     tags={"contacts"},
 *     summary="Add a new contact",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email"},
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", example="john@example.com"),
 *             @OA\Property(property="message", type="string", example="I'd like to get in touch.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Contact added successfully"
 *     )
 * )
 */
Flight::route("POST /contacts", function() {
    $request = Flight::request()->data->getData();
    Flight::json([
        'message' => "contact added successfully",
        'data' => Flight::contact_service()->add($request)
    ]);
});
/**
 * @OA\Patch(
 *     path="/contacts/{id}",
 *     tags={"contacts"},
 *     summary="Update a contact by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Contact ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Name"),
 *             @OA\Property(property="email", type="string", example="updated@example.com"),
 *             @OA\Property(property="message", type="string", example="Updated message")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Contact updated successfully"
 *     )
 * )
 */
Flight::route("PATCH /contacts/@id", function($id) {
    $blog = Flight::request()->data->getData();
    Flight::json([
        'message' => "contact eddited successfully",
        'data' => Flight::contact_service()->update($blog, $id, 'id')
    ]);
});
?>
<?php
/**
 * @OA\Get(
 *     path="/company",
 *     tags={"company"},
 *     summary="Get all companies",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all companies"
 *     )
 * )
 */
Flight::route("GET /company", function() {
    Flight::json(Flight::company_service()->get_all());
}); 
/**
 * @OA\Get(
 *     path="/company/{id}",
 *     tags={"company"},
 *     summary="Get company by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the company",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the company with the given ID"
 *     )
 * )
 */
Flight::route("GET /company/@id", function($id) {
    Flight::json(Flight::company_service()->getCompanyById($id));
}); 
/**
 * @OA\Delete(
 *     path="/company/{id}",
 *     tags={"company"},
 *     summary="Delete a company by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Company ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Company deleted successfully"
 *     )
 * )
 */
Flight::route("DELETE /company/@id", function($id) {
    Flight::company_service()->delete($id);
    Flight::json(['message' => "company has been added successfully"]);
});
/**
 * @OA\Post(
 *     path="/company",
 *     tags={"company"},
 *     summary="Add a new company",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "location"},
 *             @OA\Property(property="name", type="string", example="ACME Corporation"),
 *             @OA\Property(property="location", type="string", example="New York"),
 *             @OA\Property(property="industry", type="string", example="Technology")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Company added successfully"
 *     )
 * )
 */
Flight::route("POST /company", function() {
    $request = Flight::request()->data->getData();
    Flight::json([
        'message' => "company added successfully",
        'data' => Flight::company_service()->add($request)
    ]);
});
/**
 * @OA\Patch(
 *     path="/company/{id}",
 *     tags={"company"},
 *     summary="Update a company by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Company ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Company Name"),
 *             @OA\Property(property="location", type="string", example="Updated Location"),
 *             @OA\Property(property="industry", type="string", example="Updated Industry")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Company updated successfully"
 *     )
 * )
 */
Flight::route("PATCH /company/@id", function($id) {
    $blog = Flight::request()->data->getData();
    Flight::json([
        'message' => "company eddited successfully",
        'data' => Flight::company_service()->update($blog, $id, 'id')
    ]);
});
?>
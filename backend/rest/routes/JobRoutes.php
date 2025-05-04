<?php
/**
 * @OA\Get(
 *     path="/jobs",
 *     tags={"jobs"},
 *     summary="Get all jobs",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all jobs"
 *     )
 * )
 */
Flight::route("GET /jobs", function() {
    Flight::json(Flight::job_service()->get_all());
}); 
/**
 * @OA\Get(
 *     path="/jobs/{id}",
 *     tags={"jobs"},
 *     summary="Get job by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the job",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the job with the given ID"
 *     )
 * )
 */
Flight::route("GET /jobs/@id", function($id) {
    Flight::json(Flight::job_service()->getByJobId($id));
}); 
/**
 * @OA\Delete(
 *     path="/jobs/{id}",
 *     tags={"jobs"},
 *     summary="Delete a job by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Job ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Job deleted successfully"
 *     )
 * )
 */
Flight::route("DELETE /jobs/@id", function($id) {
    Flight::job_service()->delete($id);
    Flight::json(['message' => "job has been added successfully"]);
});
/**
 * @OA\Post(
 *     path="/jobs",
 *     tags={"jobs"},
 *     summary="Add a new job",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "description"},
 *             @OA\Property(property="title", type="string", example="Backend Developer"),
 *             @OA\Property(property="description", type="string", example="Responsible for backend systems"),
 *             @OA\Property(property="location", type="string", example="Sarajevo"),
 *             @OA\Property(property="company_id", type="integer", example=2)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Job added successfully"
 *     )
 * )
 */
Flight::route("POST /jobs", function() {
    $request = Flight::request()->data->getData();
    Flight::json([
        'message' => "job added successfully",
        'data' => Flight::job_service()->add($request)
    ]);
});
/**
 * @OA\Patch(
 *     path="/jobs/{id}",
 *     tags={"jobs"},
 *     summary="Update a job by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Job ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string", example="Updated title"),
 *             @OA\Property(property="description", type="string", example="Updated job description"),
 *             @OA\Property(property="location", type="string", example="Updated location"),
 *             @OA\Property(property="company_id", type="integer", example=2)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Job updated successfully"
 *     )
 * )
 */
Flight::route("PATCH /jobs/@id", function($id) {
    $blog = Flight::request()->data->getData();
    Flight::json([
        'message' => "job eddited successfully",
        'data' => Flight::job_service()->update($blog, $id, 'id')
    ]);
});
?>
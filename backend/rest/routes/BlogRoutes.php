<?php
/**
 * @OA\Get(
 *     path="/blogs",
 *     tags={"blogs"},
 *     summary="Get all blogs",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all blog posts"
 *     )
 * )
 */
Flight::route("GET /blogs", function() {
    Flight::json(Flight::blog_service()->get_all());
}); 

/**
 * @OA\Get(
 *     path="/blogs/{id}",
 *     tags={"blogs"},
 *     summary="Get blog post by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the blog post",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the blog post with the given ID"
 *     )
 * )
 */
Flight::route("GET /blogs/@id", function($id) {
    Flight::json(Flight::blog_service()->getByBlogId($id));
}); 

/**
 * @OA\Delete(
 *     path="/blogs/{id}",
 *     tags={"blogs"},
 *     summary="Delete a blog post by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Blog post ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Blog post deleted successfully"
 *     )
 * )
 */
Flight::route("DELETE /blogs/@id", function($id) {
    Flight::blog_service()->delete($id);
    Flight::json(['message' => "Blog has been added successfully"]);
});

/**
 * @OA\Post(
 *     path="/blogs",
 *     tags={"blogs"},
 *     summary="Add a new blog post",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "content"},
 *             @OA\Property(property="title", type="string", example="My First Blog Post"),
 *             @OA\Property(property="content", type="string", example="This is the content of the blog."),
 *             @OA\Property(property="author", type="string", example="John Doe")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Blog post added successfully"
 *     )
 * )
 */
Flight::route("POST /blogs", function() {
    $request = Flight::request()->data->getData();
    Flight::json([
        'message' => "Blog added successfully",
        'data' => Flight::blog_service()->add($request)
    ]);
});
/**
 * @OA\Patch(
 *     path="/blogs/{id}",
 *     tags={"blogs"},
 *     summary="Update a blog post by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Blog post ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string", example="Updated Blog Title"),
 *             @OA\Property(property="content", type="string", example="Updated content."),
 *             @OA\Property(property="author", type="string", example="Jane Doe")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Blog post updated successfully"
 *     )
 * )
 */
Flight::route("PATCH /blogs/@id", function($id) {
    $blog = Flight::request()->data->getData();
    Flight::json([
        'message' => "Blog eddited successfully",
        'data' => Flight::blog_service()->update($blog, $id, 'blog_id')
    ]);
});
?>
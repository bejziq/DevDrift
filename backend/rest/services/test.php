<?php
require_once __DIR__ . './ApplicationService.php';
require_once __DIR__ . './BlogService.php';



$blog_service = new BlogService();
$blogs = $blog_service->get_all();
print_r($blogs);

echo "radi sve";

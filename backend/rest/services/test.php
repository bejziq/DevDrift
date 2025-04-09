<?php
require_once 'BlogServices.php';
$blog = new BlogService();

$blogs = $blog->getByBlogId();
print_r($blogs);
?>
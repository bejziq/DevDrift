<?php
require_once __DIR__ . './ApplicationService.php';
require_once __DIR__ . './BlogService.php';

/*
$application_service = new ApplicationService();
$applications = $application_service->get_all();
print_r($applications);
*/


$blog_service = new BlogService();
$blogs = $blog_service->get_all();
print_r($blogs);


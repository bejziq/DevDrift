<?php
require 'vendor/autoload.php'; //run autoloader
require 'rest/services/ApplicationService.php';
require 'rest/services/BlogService.php';
require 'rest/services/CategoryService.php';
require 'rest/services/CompanyService.php';
require 'rest/services/ContactService.php';
require 'rest/services/JobService.php';
require 'rest/services/RoleService.php';
require 'rest/services/UserService.php';

Flight::register('application_service', "ApplicationService");
Flight::register('blog_service', "BlogService");
Flight::register('category_service', "CategoryService");
Flight::register('company_service', "CompanyService");
Flight::register('contact_service', "ContactService");
Flight::register('job_service', "JobService");
Flight::register('role_service', "RoleService");
Flight::register('user_service', "UserService");

require_once 'rest/routes/ApplicaitonRoutes.php';
require_once 'rest/routes/BlogRoutes.php';
require_once 'rest/routes/CategoryRoutes.php';
require_once 'rest/routes/CompanyRoutes.php';
require_once 'rest/routes/ContactRoutes.php';
require_once 'rest/routes/JobRoutes.php';
require_once 'rest/routes/RoleRoutes.php';
require_once 'rest/routes/UserRoutes.php';


Flight::start();  
?>

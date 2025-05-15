<?php
require 'vendor/autoload.php'; 
require 'rest/services/ApplicationService.php';
require 'rest/services/BlogService.php';
require 'rest/services/CategoryService.php';
require 'rest/services/CompanyService.php';
require 'rest/services/ContactService.php';
require 'rest/services/JobService.php';
require 'rest/services/UserService.php';
require "rest/services/AuthService.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::register('application_service', "ApplicationService");
Flight::register('blog_service', "BlogService");
Flight::register('category_service', "CategoryService");
Flight::register('company_service', "CompanyService");
Flight::register('contact_service', "ContactService");
Flight::register('job_service', "JobService");
Flight::register('user_service', "UserService");
Flight::register('auth_service', "AuthService");

Flight::route('/*', function() {
    if(
        strpos(Flight::request()->url, '/auth/login') === 0 ||
        strpos(Flight::request()->url, '/auth/register') === 0
    ) {
        return TRUE;
    } else {
        try {
            $token = Flight::request()->getHeader("Authentication");
            if(Flight::auth_middleware()->verifyToken($token))
                return TRUE;
        } catch (\Exception $e) {
            Flight::halt(401, $e->getMessage());
        }
    }
});

require_once 'rest/routes/ApplicaitonRoutes.php';
require_once 'rest/routes/BlogRoutes.php';
require_once 'rest/routes/CategoryRoutes.php';
require_once 'rest/routes/CompanyRoutes.php';
require_once 'rest/routes/ContactRoutes.php';
require_once 'rest/routes/JobRoutes.php';
require_once 'rest/routes/UserRoutes.php';
require_once 'rest/routes/AuthRoutes.php';


Flight::start();  
?>

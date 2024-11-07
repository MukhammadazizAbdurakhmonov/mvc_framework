<?php 
/**
 * This is main route file 
 * All application routes are added here
 */
use Src\Core\Router;
use Src\App\Controllers\Front\FrontPageController;

$router = new Router;

$router->add("/mvc_framework", [FrontPageController::class, "index"]);


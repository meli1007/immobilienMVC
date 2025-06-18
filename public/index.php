<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PropertyController;
use Controllers\SellersController;
use Controllers\PagesController;
use Controllers\LoginController;

$router = new Router(); 
//Admin
//Properties
$router->get('/admin', [PropertyController::class, 'index']);
$router->get('/properties/create', [PropertyController::class, 'create']);
$router->post('/properties/create', [PropertyController::class, 'create']);
$router->get('/properties/update', [PropertyController::class, 'update']);
$router->post('/properties/update', [PropertyController::class, 'update']);
$router->post('/properties/delete', [PropertyController::class, 'delete']);

//Sellers
$router->get('/sellers/create', [SellersController::class, 'create']);
$router->post('/sellers/create', [SellersController::class, 'create']);
$router->get('/sellers/update', [SellersController::class, 'update']);
$router->post('/sellers/update', [SellersController::class, 'update']);
$router->post('/sellers/delete', [SellersController::class, 'delete']);


//Public 
$router->get('/', [PagesController::class, 'index']);
$router->get('/about', [PagesController::class, 'about']);
$router->get('/listings', [PagesController::class, 'listings']);
$router->get('/listing', [PagesController::class, 'listing']);
$router->get('/blog', [PagesController::class, 'blog']);
$router->get('/entry', [PagesController::class, 'entry']);
$router->get('/contact', [PagesController::class, 'contact']);
$router->post('/contact', [PagesController::class, 'contact']);

//Login and Authentication
$router->get('/login', [LoginController::class, 'login'] );
$router->post('/login', [LoginController::class, 'login'] );
$router->get('/logout', [LoginController::class, 'logout'] );

$router->checkRoutes();




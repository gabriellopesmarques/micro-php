<?php

// load composer autoload
require '../vendor/autoload.php';

$request  = new Core\Request;
$response = new Core\Response;
$route    = new Core\Router\Routes;
$router   = new Core\Router\Router;

// load environment variables
Core\Env::load('../.env');

// load routes
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "routes.php";

// exec route
$router->exec($route, $request, $response);

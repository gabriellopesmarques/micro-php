<?php

/**
 * Set application routes
 *
 * @todo regex routes
 */

use App\Controller\ExampleController;

$route->get('/', function () {
    echo "hello world";
});

$route->get('/controller-example', [ExampleController::class, "index"]);

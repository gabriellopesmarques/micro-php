<?php

namespace Core\Router;

use Closure;
use Core\Request;
use Core\Response;
use Core\Router\Routes;

class Router
{

    /**
     * Execute a route callback
     *
     * @param   Routes    $routes    Route instantiated with a route list
     * @param   Request   $request
     * @param   Response  $response
     *
     * @return  mixed               returns the method called
     *
     * @todo validate if route exists in route list
     * @todo validate if callback is executable
     * @todo validate if callback is executable
     */
    public function exec(Routes $routes, Request $request, Response $response)
    {
        $callback = $routes->routes[$request->method][$request->uri]['callback'];

        if (gettype($callback) == "object" && $callback instanceof Closure) {
            return $callback($request, $response, $request->params);
        }

        $class = new $callback[0];
        return $class->{$callback[1]}($request, $response, $request->params);
    }
}

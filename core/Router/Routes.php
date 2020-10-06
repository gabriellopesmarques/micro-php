<?php

namespace Core\Router;

class Routes
{

    public $routes = [];

    /**
     * Add a route for get http method
     *
     * @param   string    $route     a route. Ex.: /contact
     * @param   callable  $callback  will be executable when route is called
     *
     * @return  null
     */
    public function get($route, $callback)
    {
        $this->routes['get'][$route] = [
            'callback' => $callback
        ];
    }

    /**
     * Add a route for post http method
     *
     * @param   string    $route     a route. Ex.: /contact
     * @param   callable  $callback  will be executable when route is called
     *
     * @return  null
     */
    public function post($route, $callback)
    {
        $this->routes['post'][$route] = [
            'callback' => $callback
        ];
    }

    /**
     * Add a route for put http method
     *
     * @param   string    $route     a route. Ex.: /contact
     * @param   callable  $callback  will be executable when route is called
     *
     * @return  null
     */
    public function put($route, $callback)
    {
        $this->routes['put'][$route] = [
            'callback' => $callback
        ];
    }

    /**
     * Add a route for delete http method
     *
     * @param   string    $route     a route. Ex.: /contact
     * @param   callable  $callback  will be executable when route is called
     *
     * @return  null
     */
    public function delete($route, $callback)
    {
        $this->routes['delete'][$route] = [
            'callback' => $callback
        ];
    }
}

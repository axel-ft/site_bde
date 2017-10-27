<?php

class Router {
    private $url;
    private $route = [];
    private $namedRoutes = [];

    public function __construct($url) {
        $this->url = $url;
    }

    public function get($path, $callable, $name = NULL) {
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = NULL) {
        return $this->add($path, $callable, $name, 'POST');
    }

    public function add($path, $callable, $name, $method) {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if (is_string($callable) && $name === NULL) {
            $name = $callable;
        }
        if ($name) {
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    public function run() {
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            throw new RouterException('REQUEST_METHOD n\'existe pas');
        }

        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url)) {
                return $route->call();
            }
        }

        throw new RouterException('Route inexistante');
    }

    public function url($name, $params = []) {
        if(!isset($this->namedRoutes[$name])) {
            throw new RouterException('Pas de route à ce nom');
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }
}

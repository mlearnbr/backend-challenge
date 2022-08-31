<?php

namespace MF\Init;

abstract class Bootstrap
{
    private $routes;

    abstract protected function initRoutes();

    public function __construct()
    {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    protected function getUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
    protected function run($url)
    {
        foreach ($this->getRoutes() as $path => $routes) {
            if ($url == $routes['route']) {
                $class = "App\\Controllers\\" . ucfirst($routes['controller']);

                $action = $routes['action'];

                $controller = new $class;

                $controller->$action();
            }
        }
    }
}

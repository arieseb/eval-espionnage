<?php

namespace App\Routing;

use App\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes = [];

    public function addRoute(string $name, string $url, string $httpMethod, string $controller, string $method): void
    {
        $this->routes[] = [
            'name' => $name,
            'url' => $url,
            'http_method' => $httpMethod,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function getRoute(string $uri, string $httpMethod): ?array
    {
        foreach ($this->routes as  $route) {
            if ($route['url'] === $uri && $route['http_method'] === $httpMethod) {
                return $route;
            }
        }
        return null;
    }

    /**
     * @throws RouteNotFoundException
     */
    public function execute(string $requestUri, string $requestMethod): void
    {
        $route = $this->getRoute($requestUri ,$requestMethod);
        if ($route === null) {
            throw new RouteNotFoundException($requestUri);
        }

        $controller = $route['controller'];
        $method = $route['method'];

        $controllerInstance = new $controller();
        $controllerInstance->$method();
    }
}
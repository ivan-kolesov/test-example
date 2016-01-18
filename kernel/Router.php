<?php

namespace Kernel;

use Kernel\Exceptions\BaseException;
use Kernel\Exceptions\HttpNotFoundException;

class Router
{
    protected $routes = [];

    public function get($uri, $action)
    {
        return $this->addRoute(['GET', 'HEAD'], $uri, $action);
    }

    public function post($uri, $action)
    {
        return $this->addRoute('POST', $uri, $action);
    }

    /**
     * @param array|string $methods
     * @param string $uri
     * @param string $action
     * @return Route
     */
    protected function addRoute($methods, $uri, $action)
    {
        $route = new Route($methods, $uri, $action);
        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws BaseException
     */
    public function dispatch(Request $request)
    {
        $routes = array_filter($this->routes, function (Route $route) use ($request) {
            return in_array($request->getMethod(), $route->getMethods())
                && '/' . trim($route->getUri(), '/') === $request->getBaseUrl();
        });

        if (!empty($routes)) {
            /**
             * @var Route $route
             */
            $route = reset($routes);
            return $route->run();
        } else {
            throw new HttpNotFoundException($request->getBaseUrl());
        }
    }
}
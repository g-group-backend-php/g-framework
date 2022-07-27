<?php

namespace Globe\Http\Router;

use Globe\Http\Enum\Status;
use Globe\Http\Exception\HttpException;
use Globe\Http\Request;

class Router
{
    public function __construct(
        protected array $routes
    ) {}

    public function resolve(Request $request): Route
    {
        $partialMatches = array_filter($this->routes, function (Route $route) use ($request) {
            return $route->getRoute() === $request->getUri();
        });

        if (count($partialMatches) === 0) {
            throw new HttpException(Status::NOT_FOUND, 'Route not found.');
        }

        $match = array_filter($partialMatches, function (Route $route) use ($request) {
            return $route->getMethod() === $request->getMethod();
        });

        if (count($match) === 0) {
            throw new HttpException(Status::METHOD_NOT_ALLOWED, 'Method not allowed.');
        }

        return array_pop($match);
    }
}

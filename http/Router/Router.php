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

    public function resolve(Request $request): array
    {
        $partialMatches = array_filter($this->routes, static function (Route $route) use ($request) {
            return preg_match('/^' . $route->getRoute() . '$/', $request->getUri());
        });

        if (count($partialMatches) === 0) {
            throw new HttpException(Status::NOT_FOUND, 'Route not found.');
        }

        $match = array_filter($partialMatches, static function (Route $route) use ($request) {
            return $route->getMethod() === $request->getMethod();
        });

        if (count($match) === 0) {
            throw new HttpException(Status::METHOD_NOT_ALLOWED, 'Method not allowed.');
        }

        $match = array_pop($match);

        $pathParams = $this->extractPathParams($request->getUri(), $match);

        return [$match, $pathParams];
    }

    public function extractPathParams(string $uri, Route $route): array
    {
        $values = [];

        foreach ($route->getPathParams() as $pathParam => $regex) {
            $values[$pathParam] = preg_match('/' . $regex . '/', $uri, $matches) ? $matches[0] : null;
            $uri = str_replace($values[$pathParam], '', $uri);
        }

        return $values;
    }
}

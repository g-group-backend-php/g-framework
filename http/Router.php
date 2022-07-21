<?php

namespace Globe\Http;

use App\Controller\AnotherGlobeController;
use App\Controller\GlobeController;
use Globe\Http\Enum\Method;
use Globe\Http\Model\Request;
use Globe\Http\Model\Route;

class Router
{
    protected array $routes = [];

    public function __construct()
    {
        $this->routes = [
            new Route(
                Method::GET,
                '/qwe',
                GlobeController::class,
                'show'
            ),
            new Route(
                Method::GET,
                '/another',
                AnotherGlobeController::class,
                'show'
            ),
        ];
    }

    public function resolve(Request $request): Route
    {
        $partialMatches = array_filter($this->routes, function (Route $route) use ($request) {
            return $route->getRoute() === $request->getUri();
        });

        if (count($partialMatches) === 0) {
            throw new HttpException(404, 'Route not found.');
        }

        $match = array_filter($partialMatches, function (Route $route) use ($request) {
            return $route->getMethod() === $request->getMethod();
        });

        if (count($match) === 0) {
            throw new HttpException(405, 'Method not allowed.');
        }

        return array_pop($match);
    }
}

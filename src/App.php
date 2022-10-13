<?php

namespace App;

use Globe\Http\Request;
use Globe\Http\Response\JsonResponse;
use Globe\Http\Router\Router;
use Globe\Http\Router\RouterFactory;

class App extends Kernel
{
    protected Router $router;

    public function __construct()
    {
        parent::__construct();

        $routerFactory = new RouterFactory();
        $this->router = $routerFactory->createRouter(
            $this->configManager->get('controllers')
        );
    }

    public function run(): void
    {
        [$route, $pathParams] = $this->router->resolve(Request::create());

        /** @var JsonResponse $response */
        $response = $this->callMethod($route->getController(), $route->getAction(), $pathParams);
        $response->render();
    }
}

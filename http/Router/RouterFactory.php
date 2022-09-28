<?php

namespace Globe\Http\Router;

use Globe\Finder\ClassFinder;
use Globe\Http\Attribute\Route as RouteAttribute;
use ReflectionClass;

class RouterFactory
{
    public function createRouter(array $controllersPaths): Router
    {
        $controllers = [];
        foreach ($controllersPaths as $controllersPath) {
            $controllers = [...$controllers, ...ClassFinder::findClass($controllersPath)];
        }

        $routes = [];
        foreach ($controllers as $controller) {
            $controllerClass = new ReflectionClass($controller);

            $methods = $controllerClass->getMethods();
            foreach ($methods as $method) {
                $attributes = $method->getAttributes(RouteAttribute::class);

                foreach ($attributes as $attribute) {
                    $attributeArguments = $attribute->getArguments();
                    $httpMethod = array_shift($attributeArguments);
                    $route = array_shift($attributeArguments);

                    $pathParams = $this->extractPathParams($route);

                    $routes[] = new Route(
                        $httpMethod,
                        $route,
                        $controllerClass->getName(),
                        $method->getName(),
                        $pathParams
                    );
                }
            }
        }

        return new Router($routes);
    }

    protected function extractPathParams(string &$route): array
    {
        $rawPathParams = [];
        preg_match_all('/\{[\w\d]+\:\s?\S+\}/', $route, $rawPathParams);

        $pathParams = [];
        foreach ($rawPathParams[0] as $rawPathParam) {
            $pathParam = str_replace(['{', '}'], '', $rawPathParam);
            $pathParam = explode(':', $pathParam);
            $pathParams[$pathParam[0]] = ltrim($pathParam[1]);

            $route = str_replace($rawPathParam, ltrim($pathParam[1]), $route);
        }

        $route = str_replace('/', '\/', $route);

        return $pathParams;
    }
}

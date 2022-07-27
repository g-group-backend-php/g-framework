<?php

namespace Globe\Http\Router;

use Globe\Finder\ClassFinder;
use Globe\Http\Attribute\Route as RouteAttribute;
use ReflectionClass;

class RouterFactory
{
    public function createRouter(): Router
    {
        $controllers = ClassFinder::findClass('src/Controller');

        $routes = [];
        foreach ($controllers as $controller) {
            $controllerClass = new ReflectionClass($controller);

            $methods = $controllerClass->getMethods();
            foreach ($methods as $method) {
                $attributes = $method->getAttributes(RouteAttribute::class);

                foreach ($attributes as $attribute) {
                    $attributeArguments = $attribute->getArguments();
                    $routes[] = new Route(
                        array_shift($attributeArguments),
                        array_shift($attributeArguments),
                        $controllerClass->getName(),
                        $method->getName()
                    );
                }
            }
        }

        return new Router($routes);
    }
}

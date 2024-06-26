<?php

namespace Globe\Http\Router;

use Globe\Http\Enum\Method;

class Route
{
    public function __construct(
        protected Method $method,
        protected string $route,
        protected string $controller,
        protected string $action,
        protected array $pathParams = []
    ) {}

    public function getMethod(): Method
    {
        return $this->method;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getPathParams(): array
    {
        return $this->pathParams;
    }
}

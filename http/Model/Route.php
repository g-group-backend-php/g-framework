<?php

namespace Globe\Http\Model;

use Globe\Http\Enum\Method;

class Route
{
    public function __construct(
        protected Method $method,
        protected string $route,
        protected string $controller,
        protected string $action
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
}

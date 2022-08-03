<?php

namespace Globe\Http;

use Globe\Http\Enum\Method;

class Request
{
    protected string $uri;
    protected Method $method;
    protected array $headers;
    protected array $query;
    protected array $request;
    protected ?string $content;

    public static function create(): Request
    {
        $request = new static;

        $request->uri = explode('?', $_SERVER['REQUEST_URI'])[0];
        $request->method = Method::from($_SERVER['REQUEST_METHOD']);
        $request->headers = getallheaders();
        $request->query = $_GET;
        $request->request = $_POST;
        $request->content = file_get_contents('php://input') ?: null;

        return $request;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): Method
    {
        return $this->method;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getQuery(): array
    {
        return $this->query;
    }

    public function getRequest(): array
    {
        return $this->request;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
}

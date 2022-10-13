<?php

namespace Globe\Http\Response;

use Globe\Http\Response;

class HtmlResponse implements Response
{
    public function __construct(
        protected int $statusCode,
        protected $content = null,
        protected array $headers = []
    ) {}

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function render(): void
    {
        foreach ($this->headers as $header) {
            header($header);
        }

        header("HTTP/1.0 ". $this->getStatusCode());

        echo $this->getContent();
    }
}

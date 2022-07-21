<?php

namespace Globe\Http\Model;

class Response
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

        header('Content-Type: application/json', true, $this->statusCode);

        echo json_encode($this->content);
    }
}

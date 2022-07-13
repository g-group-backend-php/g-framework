<?php

namespace App\Service;

class GlobeService
{
    public function __construct(
        protected ArrayService $arrayService
    ) {}

    public function getMessage(): array
    {
        return $this->arrayService->makeArray('msg', 'Hello Globe');
    }
}

<?php

namespace App\Service;

class ArrayService
{
    public function makeArray(string $key, string $value): array
    {
        return [$key => $value];
    }
}

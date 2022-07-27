<?php

namespace Globe\Http\Attribute;

use Attribute;
use Globe\Http\Enum\Method;

#[Attribute(Attribute::TARGET_METHOD)]
class Route
{
    public function __construct(
        Method $method,
        string $path
    ) {}
}

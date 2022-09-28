<?php

namespace Globe\ConfigManager;

class ServiceMetadata
{
    public function __construct(
        public readonly array $arguments,
        public readonly array $tags,
    ) {}
}

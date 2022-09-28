<?php

namespace Globe\Console;

abstract class Command
{
    public function __construct(
        public readonly string $name
    ) {}

    abstract public function run(Input $input): int;
}

<?php

namespace Globe\Console;

class Input
{
    protected string $commandName;
    protected array $arguments;

    public static function create(): Input
    {
        $input = new static;

        $argv = $_SERVER['argv'];

        $input->commandName = $argv[1];
        $input->arguments = array_splice($argv, 2);

        return $input;
    }

    public function getCommandName(): string
    {
        return $this->commandName;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }
}

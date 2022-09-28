<?php

namespace Globe\Console;

class CommandManager
{
    public function __construct(
        protected array $commands
    ) {}

    public function resolve(Input $input): Command
    {
        if (!array_key_exists($input->getCommandName(), $this->commands)) {
            throw new \RuntimeException(sprintf('%s command not found.', $input->getCommandName()));
        }

        return $this->commands[$input->getCommandName()];
    }
}

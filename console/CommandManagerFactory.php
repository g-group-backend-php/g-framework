<?php

namespace Globe\Console;

use Globe\Finder\ClassFinder;

class CommandManagerFactory
{
    public function createCommandManager(array $commandsPaths): CommandManager
    {
        $commandsClasses = [];
        foreach ($commandsPaths as $commandsPath) {
            $commandsClasses = [...$commandsClasses, ...ClassFinder::findClass($commandsPath)];
        }
        $commandsClasses = array_map(fn (string $class) => new $class, $commandsClasses);

        $commands = [];
        /** @var Command $command */
        foreach ($commandsClasses as $command) {
            $commands[$command->name] = $command;
        }

        return new CommandManager($commands);
    }
}

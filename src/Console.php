<?php

namespace App;

use Globe\Console\CommandManager;
use Globe\Console\CommandManagerFactory;
use Globe\Console\Input;

class Console extends Kernel
{
    protected CommandManager $commandManager;

    public function __construct()
    {
        parent::__construct();

        $commandManagerFactory = new CommandManagerFactory();
        $this->commandManager = $commandManagerFactory->createCommandManager(
            $this->configManager->get('commands')
        );
    }

    public function run(): void
    {
        $input = Input::create();
        $command = $this->commandManager->resolve($input);

        $command->run($input);
    }
}

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

        $this->container->set(Input::create(), Input::class);
    }

    public function run(): void
    {
        $command = $this->commandManager->resolve($this->container->get(Input::class));

        $this->callMethod($command::class, 'run');
    }
}

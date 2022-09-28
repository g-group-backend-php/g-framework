<?php

namespace App\Command;

use Globe\Console\Input;
use Globe\Console\Command;
use Globe\Console\CommandStatus;

class Spin extends Command
{
    public function __construct()
    {
        parent::__construct('spin');
    }

    public function run(Input $input): int
    {
        exec(sprintf('php -S %s', $input->getArguments()[0]));

        return CommandStatus::SUCCESS;
    }
}

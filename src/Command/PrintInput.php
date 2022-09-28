<?php

namespace App\Command;

use Globe\Console\Input;
use Globe\Console\Command;
use Globe\Console\CommandStatus;

class PrintInput extends Command
{
    public function __construct()
    {
        parent::__construct('print:input');
    }

    public function run(Input $input): int
    {
        echo $input->getArguments()[0];

        return CommandStatus::SUCCESS;
    }
}

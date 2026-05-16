<?php

namespace App\Console\Commands\Production;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:machine-labor-command')]
#[Description('Command description')]
class MachineLaborCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}

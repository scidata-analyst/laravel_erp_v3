<?php

namespace App\Console\Commands\Reports;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:custom-reports-command')]
#[Description('Command description')]
class CustomReportsCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}

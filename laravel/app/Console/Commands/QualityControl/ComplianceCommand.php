<?php

namespace App\Console\Commands\QualityControl;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:compliance-command')]
#[Description('Command description')]
class ComplianceCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}

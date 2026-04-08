<?php

namespace App\Console\Commands\QualityControl;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:qc-checklists-command')]
#[Description('Command description')]
class QcChecklistsCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}

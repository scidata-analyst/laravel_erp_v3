<?php

namespace App\Console\Commands\Documents;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:doc-library-command')]
#[Description('Command description')]
class DocLibraryCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}

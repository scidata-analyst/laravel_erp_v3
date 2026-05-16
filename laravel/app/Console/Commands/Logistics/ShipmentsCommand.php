<?php

namespace App\Console\Commands\Logistics;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:shipments-command')]
#[Description('Command description')]
class ShipmentsCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}

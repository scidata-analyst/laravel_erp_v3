<?php

namespace App\Console\Commands\Inventory;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:stock-movements-command')]
#[Description('Command description')]
class StockMovementsCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}

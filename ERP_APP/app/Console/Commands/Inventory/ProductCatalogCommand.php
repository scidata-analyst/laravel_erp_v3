<?php

namespace App\Console\Commands\Inventory;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:product-catalog-command')]
#[Description('Command description')]
class ProductCatalogCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}

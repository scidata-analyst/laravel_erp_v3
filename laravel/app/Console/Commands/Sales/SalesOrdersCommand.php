<?php

namespace App\Console\Commands\Sales;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:sales-orders-command')]
#[Description('Command description')]
class SalesOrdersCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}

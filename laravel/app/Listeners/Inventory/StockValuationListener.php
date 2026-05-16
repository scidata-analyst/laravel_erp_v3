<?php

namespace App\Listeners\Inventory;

use App\Events\Inventory\StockValuationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StockValuationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StockValuationEvent $event): void
    {
        //
    }
}

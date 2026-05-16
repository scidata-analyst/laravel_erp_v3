<?php

namespace App\Listeners\Inventory;

use App\Events\Inventory\StockMovementsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StockMovementsListener
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
    public function handle(StockMovementsEvent $event): void
    {
        //
    }
}

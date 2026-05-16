<?php

namespace App\Listeners\Logistics;

use App\Events\Logistics\WarehousesEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WarehousesListener
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
    public function handle(WarehousesEvent $event): void
    {
        //
    }
}

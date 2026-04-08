<?php

namespace App\Listeners\Logistics;

use App\Events\Logistics\ShipmentsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ShipmentsListener
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
    public function handle(ShipmentsEvent $event): void
    {
        //
    }
}

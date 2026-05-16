<?php

namespace App\Listeners\Inventory;

use App\Events\Inventory\BatchTrackingEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BatchTrackingListener
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
    public function handle(BatchTrackingEvent $event): void
    {
        //
    }
}

<?php

namespace App\Listeners\Ecommerce;

use App\Events\Ecommerce\InvSyncEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InvSyncListener
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
    public function handle(InvSyncEvent $event): void
    {
        //
    }
}

<?php

namespace App\Listeners\Ecommerce;

use App\Events\Ecommerce\PosEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PosListener
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
    public function handle(PosEvent $event): void
    {
        //
    }
}

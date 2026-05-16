<?php

namespace App\Listeners\Purchase;

use App\Events\Purchase\SuppliersEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SuppliersListener
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
    public function handle(SuppliersEvent $event): void
    {
        //
    }
}

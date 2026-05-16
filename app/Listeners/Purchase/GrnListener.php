<?php

namespace App\Listeners\Purchase;

use App\Events\Purchase\GrnEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GrnListener
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
    public function handle(GrnEvent $event): void
    {
        //
    }
}

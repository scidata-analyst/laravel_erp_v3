<?php

namespace App\Listeners\Production;

use App\Events\Production\MachineLaborEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MachineLaborListener
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
    public function handle(MachineLaborEvent $event): void
    {
        //
    }
}

<?php

namespace App\Listeners\HR;

use App\Events\HR\PerformanceEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PerformanceListener
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
    public function handle(PerformanceEvent $event): void
    {
        //
    }
}

<?php

namespace App\Listeners\Production;

use App\Events\Production\WorkOrdersEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WorkOrdersListener
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
    public function handle(WorkOrdersEvent $event): void
    {
        //
    }
}

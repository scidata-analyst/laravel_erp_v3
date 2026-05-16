<?php

namespace App\Listeners\Reports;

use App\Events\Reports\BiDashboardsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BiDashboardsListener
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
    public function handle(BiDashboardsEvent $event): void
    {
        //
    }
}

<?php

namespace App\Listeners\Core;

use App\Events\Core\DashboardEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DashboardListener
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
    public function handle(DashboardEvent $event): void
    {
        //
    }
}

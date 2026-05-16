<?php

namespace App\Listeners\Reports;

use App\Events\Reports\CustomReportsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CustomReportsListener
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
    public function handle(CustomReportsEvent $event): void
    {
        //
    }
}

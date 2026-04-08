<?php

namespace App\Listeners\Accounting;

use App\Events\Accounting\FinReportsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FinReportsListener
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
    public function handle(FinReportsEvent $event): void
    {
        //
    }
}

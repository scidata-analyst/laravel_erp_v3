<?php

namespace App\Listeners\Accounting;

use App\Events\Accounting\ApArEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ApArListener
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
    public function handle(ApArEvent $event): void
    {
        //
    }
}

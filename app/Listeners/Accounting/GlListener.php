<?php

namespace App\Listeners\Accounting;

use App\Events\Accounting\GlEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GlListener
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
    public function handle(GlEvent $event): void
    {
        //
    }
}

<?php

namespace App\Listeners\Accounting;

use App\Events\Accounting\TaxEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TaxListener
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
    public function handle(TaxEvent $event): void
    {
        //
    }
}

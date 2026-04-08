<?php

namespace App\Listeners\HR;

use App\Events\HR\PayrollEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PayrollListener
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
    public function handle(PayrollEvent $event): void
    {
        //
    }
}

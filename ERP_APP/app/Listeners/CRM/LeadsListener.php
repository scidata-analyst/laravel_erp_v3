<?php

namespace App\Listeners\CRM;

use App\Events\CRM\LeadsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LeadsListener
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
    public function handle(LeadsEvent $event): void
    {
        //
    }
}

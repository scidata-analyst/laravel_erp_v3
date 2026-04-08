<?php

namespace App\Listeners\CRM;

use App\Events\CRM\InteractionsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InteractionsListener
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
    public function handle(InteractionsEvent $event): void
    {
        //
    }
}

<?php

namespace App\Listeners\Sales;

use App\Events\Sales\CustomersEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CustomersListener
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
    public function handle(CustomersEvent $event): void
    {
        //
    }
}

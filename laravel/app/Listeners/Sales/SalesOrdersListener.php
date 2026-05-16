<?php

namespace App\Listeners\Sales;

use App\Events\Sales\SalesOrdersEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SalesOrdersListener
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
    public function handle(SalesOrdersEvent $event): void
    {
        //
    }
}

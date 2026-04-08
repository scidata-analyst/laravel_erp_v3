<?php

namespace App\Listeners\Sales;

use App\Events\Sales\InvoicesEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InvoicesListener
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
    public function handle(InvoicesEvent $event): void
    {
        //
    }
}

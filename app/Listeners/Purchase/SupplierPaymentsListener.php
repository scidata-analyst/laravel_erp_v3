<?php

namespace App\Listeners\Purchase;

use App\Events\Purchase\SupplierPaymentsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SupplierPaymentsListener
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
    public function handle(SupplierPaymentsEvent $event): void
    {
        //
    }
}

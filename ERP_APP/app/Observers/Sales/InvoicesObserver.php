<?php

namespace App\Observers\Sales;

use App\Models\Sales\Invoices;

class InvoicesObserver
{
    /**
     * Handle the Invoices "created" event.
     */
    public function created(Invoices $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Invoices "updated" event.
     */
    public function updated(Invoices $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Invoices "deleted" event.
     */
    public function deleted(Invoices $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Invoices "restored" event.
     */
    public function restored(Invoices $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Invoices "forceDeleted" event.
     */
    public function forceDeleted(Invoices $modelVar): void
    {
        // ...
    }
}

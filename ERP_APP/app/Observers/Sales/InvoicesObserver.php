<?php

namespace App\Observers\Sales;

use App\Models\Sales\Invoices;

class InvoicesObserver
{
    /**
     * Handle the Invoices "created" event.
     */
    public function created(Invoices $invoices): void
    {
        //
    }

    /**
     * Handle the Invoices "updated" event.
     */
    public function updated(Invoices $invoices): void
    {
        //
    }

    /**
     * Handle the Invoices "deleted" event.
     */
    public function deleted(Invoices $invoices): void
    {
        //
    }

    /**
     * Handle the Invoices "restored" event.
     */
    public function restored(Invoices $invoices): void
    {
        //
    }

    /**
     * Handle the Invoices "force deleted" event.
     */
    public function forceDeleted(Invoices $invoices): void
    {
        //
    }
}

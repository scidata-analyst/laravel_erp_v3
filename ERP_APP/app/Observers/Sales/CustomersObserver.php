<?php

namespace App\Observers\Sales;

use App\Models\Sales\Customers;

class CustomersObserver
{
    /**
     * Handle the Customers "created" event.
     */
    public function created(Customers $customers): void
    {
        //
    }

    /**
     * Handle the Customers "updated" event.
     */
    public function updated(Customers $customers): void
    {
        //
    }

    /**
     * Handle the Customers "deleted" event.
     */
    public function deleted(Customers $customers): void
    {
        //
    }

    /**
     * Handle the Customers "restored" event.
     */
    public function restored(Customers $customers): void
    {
        //
    }

    /**
     * Handle the Customers "force deleted" event.
     */
    public function forceDeleted(Customers $customers): void
    {
        //
    }
}

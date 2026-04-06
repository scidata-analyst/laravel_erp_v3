<?php

namespace App\Observers\Sales;

use App\Models\Sales\Customers;

class CustomersObserver
{
    /**
     * Handle the Customers "created" event.
     */
    public function created(Customers $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Customers "updated" event.
     */
    public function updated(Customers $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Customers "deleted" event.
     */
    public function deleted(Customers $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Customers "restored" event.
     */
    public function restored(Customers $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Customers "forceDeleted" event.
     */
    public function forceDeleted(Customers $modelVar): void
    {
        // ...
    }
}

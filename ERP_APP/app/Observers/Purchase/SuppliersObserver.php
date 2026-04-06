<?php

namespace App\Observers\Purchase;

use App\Models\Purchase\Suppliers;

class SuppliersObserver
{
    /**
     * Handle the Suppliers "created" event.
     */
    public function created(Suppliers $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Suppliers "updated" event.
     */
    public function updated(Suppliers $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Suppliers "deleted" event.
     */
    public function deleted(Suppliers $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Suppliers "restored" event.
     */
    public function restored(Suppliers $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Suppliers "forceDeleted" event.
     */
    public function forceDeleted(Suppliers $modelVar): void
    {
        // ...
    }
}

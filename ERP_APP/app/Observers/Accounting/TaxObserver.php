<?php

namespace App\Observers\Accounting;

use App\Models\Accounting\Tax;

class TaxObserver
{
    /**
     * Handle the Tax "created" event.
     */
    public function created(Tax $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Tax "updated" event.
     */
    public function updated(Tax $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Tax "deleted" event.
     */
    public function deleted(Tax $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Tax "restored" event.
     */
    public function restored(Tax $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Tax "forceDeleted" event.
     */
    public function forceDeleted(Tax $modelVar): void
    {
        // ...
    }
}

<?php

namespace App\Observers\CRM;

use App\Models\CRM\Interactions;

class InteractionsObserver
{
    /**
     * Handle the Interactions "created" event.
     */
    public function created(Interactions $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Interactions "updated" event.
     */
    public function updated(Interactions $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Interactions "deleted" event.
     */
    public function deleted(Interactions $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Interactions "restored" event.
     */
    public function restored(Interactions $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Interactions "forceDeleted" event.
     */
    public function forceDeleted(Interactions $modelVar): void
    {
        // ...
    }
}

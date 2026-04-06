<?php

namespace App\Observers\CRM;

use App\Models\CRM\Leads;

class LeadsObserver
{
    /**
     * Handle the Leads "created" event.
     */
    public function created(Leads $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Leads "updated" event.
     */
    public function updated(Leads $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Leads "deleted" event.
     */
    public function deleted(Leads $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Leads "restored" event.
     */
    public function restored(Leads $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Leads "forceDeleted" event.
     */
    public function forceDeleted(Leads $modelVar): void
    {
        // ...
    }
}

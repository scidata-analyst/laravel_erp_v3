<?php

namespace App\Observers\CRM;

use App\Models\CRM\Support;

class SupportObserver
{
    /**
     * Handle the Support "created" event.
     */
    public function created(Support $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Support "updated" event.
     */
    public function updated(Support $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Support "deleted" event.
     */
    public function deleted(Support $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Support "restored" event.
     */
    public function restored(Support $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Support "forceDeleted" event.
     */
    public function forceDeleted(Support $modelVar): void
    {
        // ...
    }
}

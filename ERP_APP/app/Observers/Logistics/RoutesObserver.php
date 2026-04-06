<?php

namespace App\Observers\Logistics;

use App\Models\Logistics\Routes;

class RoutesObserver
{
    /**
     * Handle the Routes "created" event.
     */
    public function created(Routes $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Routes "updated" event.
     */
    public function updated(Routes $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Routes "deleted" event.
     */
    public function deleted(Routes $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Routes "restored" event.
     */
    public function restored(Routes $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Routes "forceDeleted" event.
     */
    public function forceDeleted(Routes $modelVar): void
    {
        // ...
    }
}

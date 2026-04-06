<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\InvSync;

class InvSyncObserver
{
    /**
     * Handle the InvSync "created" event.
     */
    public function created(InvSync $modelVar): void
    {
        // ...
    }

    /**
     * Handle the InvSync "updated" event.
     */
    public function updated(InvSync $modelVar): void
    {
        // ...
    }

    /**
     * Handle the InvSync "deleted" event.
     */
    public function deleted(InvSync $modelVar): void
    {
        // ...
    }

    /**
     * Handle the InvSync "restored" event.
     */
    public function restored(InvSync $modelVar): void
    {
        // ...
    }

    /**
     * Handle the InvSync "forceDeleted" event.
     */
    public function forceDeleted(InvSync $modelVar): void
    {
        // ...
    }
}

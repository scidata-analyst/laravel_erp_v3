<?php

namespace App\Observers\Projects;

use App\Models\Projects\Resources;

class ResourcesObserver
{
    /**
     * Handle the Resources "created" event.
     */
    public function created(Resources $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Resources "updated" event.
     */
    public function updated(Resources $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Resources "deleted" event.
     */
    public function deleted(Resources $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Resources "restored" event.
     */
    public function restored(Resources $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Resources "forceDeleted" event.
     */
    public function forceDeleted(Resources $modelVar): void
    {
        // ...
    }
}

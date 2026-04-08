<?php

namespace App\Observers\Projects;

use App\Models\Projects\Resources;

class ResourcesObserver
{
    /**
     * Handle the Resources "created" event.
     */
    public function created(Resources $resources): void
    {
        //
    }

    /**
     * Handle the Resources "updated" event.
     */
    public function updated(Resources $resources): void
    {
        //
    }

    /**
     * Handle the Resources "deleted" event.
     */
    public function deleted(Resources $resources): void
    {
        //
    }

    /**
     * Handle the Resources "restored" event.
     */
    public function restored(Resources $resources): void
    {
        //
    }

    /**
     * Handle the Resources "force deleted" event.
     */
    public function forceDeleted(Resources $resources): void
    {
        //
    }
}

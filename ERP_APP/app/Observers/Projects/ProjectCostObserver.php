<?php

namespace App\Observers\Projects;

use App\Models\Projects\ProjectCost;

class ProjectCostObserver
{
    /**
     * Handle the ProjectCost "created" event.
     */
    public function created(ProjectCost $modelVar): void
    {
        // ...
    }

    /**
     * Handle the ProjectCost "updated" event.
     */
    public function updated(ProjectCost $modelVar): void
    {
        // ...
    }

    /**
     * Handle the ProjectCost "deleted" event.
     */
    public function deleted(ProjectCost $modelVar): void
    {
        // ...
    }

    /**
     * Handle the ProjectCost "restored" event.
     */
    public function restored(ProjectCost $modelVar): void
    {
        // ...
    }

    /**
     * Handle the ProjectCost "forceDeleted" event.
     */
    public function forceDeleted(ProjectCost $modelVar): void
    {
        // ...
    }
}

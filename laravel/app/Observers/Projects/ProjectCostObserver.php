<?php

namespace App\Observers\Projects;

use App\Models\Projects\ProjectCost;

class ProjectCostObserver
{
    /**
     * Handle the ProjectCost "created" event.
     */
    public function created(ProjectCost $projectCost): void
    {
        //
    }

    /**
     * Handle the ProjectCost "updated" event.
     */
    public function updated(ProjectCost $projectCost): void
    {
        //
    }

    /**
     * Handle the ProjectCost "deleted" event.
     */
    public function deleted(ProjectCost $projectCost): void
    {
        //
    }

    /**
     * Handle the ProjectCost "restored" event.
     */
    public function restored(ProjectCost $projectCost): void
    {
        //
    }

    /**
     * Handle the ProjectCost "force deleted" event.
     */
    public function forceDeleted(ProjectCost $projectCost): void
    {
        //
    }
}

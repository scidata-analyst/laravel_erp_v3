<?php

namespace App\Observers\Projects;

use App\Models\Projects\Tasks;

class TasksObserver
{
    /**
     * Handle the Tasks "created" event.
     */
    public function created(Tasks $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Tasks "updated" event.
     */
    public function updated(Tasks $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Tasks "deleted" event.
     */
    public function deleted(Tasks $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Tasks "restored" event.
     */
    public function restored(Tasks $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Tasks "forceDeleted" event.
     */
    public function forceDeleted(Tasks $modelVar): void
    {
        // ...
    }
}

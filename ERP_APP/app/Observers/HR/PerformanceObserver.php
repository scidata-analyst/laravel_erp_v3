<?php

namespace App\Observers\HR;

use App\Models\HR\Performance;

class PerformanceObserver
{
    /**
     * Handle the Performance "created" event.
     */
    public function created(Performance $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Performance "updated" event.
     */
    public function updated(Performance $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Performance "deleted" event.
     */
    public function deleted(Performance $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Performance "restored" event.
     */
    public function restored(Performance $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Performance "forceDeleted" event.
     */
    public function forceDeleted(Performance $modelVar): void
    {
        // ...
    }
}

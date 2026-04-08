<?php

namespace App\Observers\HR;

use App\Models\HR\Performance;

class PerformanceObserver
{
    /**
     * Handle the Performance "created" event.
     */
    public function created(Performance $performance): void
    {
        //
    }

    /**
     * Handle the Performance "updated" event.
     */
    public function updated(Performance $performance): void
    {
        //
    }

    /**
     * Handle the Performance "deleted" event.
     */
    public function deleted(Performance $performance): void
    {
        //
    }

    /**
     * Handle the Performance "restored" event.
     */
    public function restored(Performance $performance): void
    {
        //
    }

    /**
     * Handle the Performance "force deleted" event.
     */
    public function forceDeleted(Performance $performance): void
    {
        //
    }
}

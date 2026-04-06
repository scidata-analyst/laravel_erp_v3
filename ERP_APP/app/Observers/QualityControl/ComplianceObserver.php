<?php

namespace App\Observers\QualityControl;

use App\Models\QualityControl\Compliance;

class ComplianceObserver
{
    /**
     * Handle the Compliance "created" event.
     */
    public function created(Compliance $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Compliance "updated" event.
     */
    public function updated(Compliance $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Compliance "deleted" event.
     */
    public function deleted(Compliance $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Compliance "restored" event.
     */
    public function restored(Compliance $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Compliance "forceDeleted" event.
     */
    public function forceDeleted(Compliance $modelVar): void
    {
        // ...
    }
}

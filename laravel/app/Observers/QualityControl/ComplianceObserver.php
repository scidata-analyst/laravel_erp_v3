<?php

namespace App\Observers\QualityControl;

use App\Models\QualityControl\Compliance;

class ComplianceObserver
{
    /**
     * Handle the Compliance "created" event.
     */
    public function created(Compliance $compliance): void
    {
        //
    }

    /**
     * Handle the Compliance "updated" event.
     */
    public function updated(Compliance $compliance): void
    {
        //
    }

    /**
     * Handle the Compliance "deleted" event.
     */
    public function deleted(Compliance $compliance): void
    {
        //
    }

    /**
     * Handle the Compliance "restored" event.
     */
    public function restored(Compliance $compliance): void
    {
        //
    }

    /**
     * Handle the Compliance "force deleted" event.
     */
    public function forceDeleted(Compliance $compliance): void
    {
        //
    }
}

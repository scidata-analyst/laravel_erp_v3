<?php

namespace App\Observers\QualityControl;

use App\Models\QualityControl\Defects;

class DefectsObserver
{
    /**
     * Handle the Defects "created" event.
     */
    public function created(Defects $defects): void
    {
        //
    }

    /**
     * Handle the Defects "updated" event.
     */
    public function updated(Defects $defects): void
    {
        //
    }

    /**
     * Handle the Defects "deleted" event.
     */
    public function deleted(Defects $defects): void
    {
        //
    }

    /**
     * Handle the Defects "restored" event.
     */
    public function restored(Defects $defects): void
    {
        //
    }

    /**
     * Handle the Defects "force deleted" event.
     */
    public function forceDeleted(Defects $defects): void
    {
        //
    }
}

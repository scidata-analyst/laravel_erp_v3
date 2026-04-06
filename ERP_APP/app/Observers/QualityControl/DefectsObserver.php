<?php

namespace App\Observers\QualityControl;

use App\Models\QualityControl\Defects;

class DefectsObserver
{
    /**
     * Handle the Defects "created" event.
     */
    public function created(Defects $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Defects "updated" event.
     */
    public function updated(Defects $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Defects "deleted" event.
     */
    public function deleted(Defects $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Defects "restored" event.
     */
    public function restored(Defects $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Defects "forceDeleted" event.
     */
    public function forceDeleted(Defects $modelVar): void
    {
        // ...
    }
}

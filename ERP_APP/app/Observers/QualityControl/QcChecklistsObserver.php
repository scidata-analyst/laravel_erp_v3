<?php

namespace App\Observers\QualityControl;

use App\Models\QualityControl\QcChecklists;

class QcChecklistsObserver
{
    /**
     * Handle the QcChecklists "created" event.
     */
    public function created(QcChecklists $modelVar): void
    {
        // ...
    }

    /**
     * Handle the QcChecklists "updated" event.
     */
    public function updated(QcChecklists $modelVar): void
    {
        // ...
    }

    /**
     * Handle the QcChecklists "deleted" event.
     */
    public function deleted(QcChecklists $modelVar): void
    {
        // ...
    }

    /**
     * Handle the QcChecklists "restored" event.
     */
    public function restored(QcChecklists $modelVar): void
    {
        // ...
    }

    /**
     * Handle the QcChecklists "forceDeleted" event.
     */
    public function forceDeleted(QcChecklists $modelVar): void
    {
        // ...
    }
}

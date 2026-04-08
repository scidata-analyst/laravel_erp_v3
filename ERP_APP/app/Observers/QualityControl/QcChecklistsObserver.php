<?php

namespace App\Observers\QualityControl;

use App\Models\QualityControl\QcChecklists;

class QcChecklistsObserver
{
    /**
     * Handle the QcChecklists "created" event.
     */
    public function created(QcChecklists $qcChecklists): void
    {
        //
    }

    /**
     * Handle the QcChecklists "updated" event.
     */
    public function updated(QcChecklists $qcChecklists): void
    {
        //
    }

    /**
     * Handle the QcChecklists "deleted" event.
     */
    public function deleted(QcChecklists $qcChecklists): void
    {
        //
    }

    /**
     * Handle the QcChecklists "restored" event.
     */
    public function restored(QcChecklists $qcChecklists): void
    {
        //
    }

    /**
     * Handle the QcChecklists "force deleted" event.
     */
    public function forceDeleted(QcChecklists $qcChecklists): void
    {
        //
    }
}

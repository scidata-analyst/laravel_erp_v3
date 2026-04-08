<?php

namespace App\Observers\Accounting;

use App\Models\Accounting\ApAr;

class ApArObserver
{
    /**
     * Handle the ApAr "created" event.
     */
    public function created(ApAr $apAr): void
    {
        //
    }

    /**
     * Handle the ApAr "updated" event.
     */
    public function updated(ApAr $apAr): void
    {
        //
    }

    /**
     * Handle the ApAr "deleted" event.
     */
    public function deleted(ApAr $apAr): void
    {
        //
    }

    /**
     * Handle the ApAr "restored" event.
     */
    public function restored(ApAr $apAr): void
    {
        //
    }

    /**
     * Handle the ApAr "force deleted" event.
     */
    public function forceDeleted(ApAr $apAr): void
    {
        //
    }
}

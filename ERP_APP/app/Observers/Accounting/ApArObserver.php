<?php

namespace App\Observers\Accounting;

use App\Models\Accounting\ApAr;

class ApArObserver
{
    /**
     * Handle the ApAr "created" event.
     */
    public function created(ApAr $modelVar): void
    {
        // ...
    }

    /**
     * Handle the ApAr "updated" event.
     */
    public function updated(ApAr $modelVar): void
    {
        // ...
    }

    /**
     * Handle the ApAr "deleted" event.
     */
    public function deleted(ApAr $modelVar): void
    {
        // ...
    }

    /**
     * Handle the ApAr "restored" event.
     */
    public function restored(ApAr $modelVar): void
    {
        // ...
    }

    /**
     * Handle the ApAr "forceDeleted" event.
     */
    public function forceDeleted(ApAr $modelVar): void
    {
        // ...
    }
}

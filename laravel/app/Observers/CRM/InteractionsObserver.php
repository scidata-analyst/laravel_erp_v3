<?php

namespace App\Observers\CRM;

use App\Models\CRM\Interactions;

class InteractionsObserver
{
    /**
     * Handle the Interactions "created" event.
     */
    public function created(Interactions $interactions): void
    {
        //
    }

    /**
     * Handle the Interactions "updated" event.
     */
    public function updated(Interactions $interactions): void
    {
        //
    }

    /**
     * Handle the Interactions "deleted" event.
     */
    public function deleted(Interactions $interactions): void
    {
        //
    }

    /**
     * Handle the Interactions "restored" event.
     */
    public function restored(Interactions $interactions): void
    {
        //
    }

    /**
     * Handle the Interactions "force deleted" event.
     */
    public function forceDeleted(Interactions $interactions): void
    {
        //
    }
}

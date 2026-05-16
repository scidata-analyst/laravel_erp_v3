<?php

namespace App\Observers\CRM;

use App\Models\CRM\Leads;

class LeadsObserver
{
    /**
     * Handle the Leads "created" event.
     */
    public function created(Leads $leads): void
    {
        //
    }

    /**
     * Handle the Leads "updated" event.
     */
    public function updated(Leads $leads): void
    {
        //
    }

    /**
     * Handle the Leads "deleted" event.
     */
    public function deleted(Leads $leads): void
    {
        //
    }

    /**
     * Handle the Leads "restored" event.
     */
    public function restored(Leads $leads): void
    {
        //
    }

    /**
     * Handle the Leads "force deleted" event.
     */
    public function forceDeleted(Leads $leads): void
    {
        //
    }
}

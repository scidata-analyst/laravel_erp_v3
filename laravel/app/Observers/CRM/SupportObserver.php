<?php

namespace App\Observers\CRM;

use App\Models\CRM\Support;

class SupportObserver
{
    /**
     * Handle the Support "created" event.
     */
    public function created(Support $support): void
    {
        //
    }

    /**
     * Handle the Support "updated" event.
     */
    public function updated(Support $support): void
    {
        //
    }

    /**
     * Handle the Support "deleted" event.
     */
    public function deleted(Support $support): void
    {
        //
    }

    /**
     * Handle the Support "restored" event.
     */
    public function restored(Support $support): void
    {
        //
    }

    /**
     * Handle the Support "force deleted" event.
     */
    public function forceDeleted(Support $support): void
    {
        //
    }
}

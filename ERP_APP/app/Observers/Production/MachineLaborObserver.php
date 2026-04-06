<?php

namespace App\Observers\Production;

use App\Models\Production\MachineLabor;

class MachineLaborObserver
{
    /**
     * Handle the MachineLabor "created" event.
     */
    public function created(MachineLabor $modelVar): void
    {
        // ...
    }

    /**
     * Handle the MachineLabor "updated" event.
     */
    public function updated(MachineLabor $modelVar): void
    {
        // ...
    }

    /**
     * Handle the MachineLabor "deleted" event.
     */
    public function deleted(MachineLabor $modelVar): void
    {
        // ...
    }

    /**
     * Handle the MachineLabor "restored" event.
     */
    public function restored(MachineLabor $modelVar): void
    {
        // ...
    }

    /**
     * Handle the MachineLabor "forceDeleted" event.
     */
    public function forceDeleted(MachineLabor $modelVar): void
    {
        // ...
    }
}

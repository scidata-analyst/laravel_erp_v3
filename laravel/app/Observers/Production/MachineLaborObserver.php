<?php

namespace App\Observers\Production;

use App\Models\Production\MachineLabor;

class MachineLaborObserver
{
    /**
     * Handle the MachineLabor "created" event.
     */
    public function created(MachineLabor $machineLabor): void
    {
        //
    }

    /**
     * Handle the MachineLabor "updated" event.
     */
    public function updated(MachineLabor $machineLabor): void
    {
        //
    }

    /**
     * Handle the MachineLabor "deleted" event.
     */
    public function deleted(MachineLabor $machineLabor): void
    {
        //
    }

    /**
     * Handle the MachineLabor "restored" event.
     */
    public function restored(MachineLabor $machineLabor): void
    {
        //
    }

    /**
     * Handle the MachineLabor "force deleted" event.
     */
    public function forceDeleted(MachineLabor $machineLabor): void
    {
        //
    }
}

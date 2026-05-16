<?php

namespace App\Observers\HR;

use App\Models\HR\Employees;

class EmployeesObserver
{
    /**
     * Handle the Employees "created" event.
     */
    public function created(Employees $employees): void
    {
        //
    }

    /**
     * Handle the Employees "updated" event.
     */
    public function updated(Employees $employees): void
    {
        //
    }

    /**
     * Handle the Employees "deleted" event.
     */
    public function deleted(Employees $employees): void
    {
        //
    }

    /**
     * Handle the Employees "restored" event.
     */
    public function restored(Employees $employees): void
    {
        //
    }

    /**
     * Handle the Employees "force deleted" event.
     */
    public function forceDeleted(Employees $employees): void
    {
        //
    }
}

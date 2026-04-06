<?php

namespace App\Observers\HR;

use App\Models\HR\Employees;

class EmployeesObserver
{
    /**
     * Handle the Employees "created" event.
     */
    public function created(Employees $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Employees "updated" event.
     */
    public function updated(Employees $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Employees "deleted" event.
     */
    public function deleted(Employees $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Employees "restored" event.
     */
    public function restored(Employees $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Employees "forceDeleted" event.
     */
    public function forceDeleted(Employees $modelVar): void
    {
        // ...
    }
}

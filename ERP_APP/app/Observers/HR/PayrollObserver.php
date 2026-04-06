<?php

namespace App\Observers\HR;

use App\Models\HR\Payroll;

class PayrollObserver
{
    /**
     * Handle the Payroll "created" event.
     */
    public function created(Payroll $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Payroll "updated" event.
     */
    public function updated(Payroll $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Payroll "deleted" event.
     */
    public function deleted(Payroll $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Payroll "restored" event.
     */
    public function restored(Payroll $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Payroll "forceDeleted" event.
     */
    public function forceDeleted(Payroll $modelVar): void
    {
        // ...
    }
}

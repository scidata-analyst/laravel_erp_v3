<?php

namespace App\Observers\HR;

use App\Models\HR\Attendance;

class AttendanceObserver
{
    /**
     * Handle the Attendance "created" event.
     */
    public function created(Attendance $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Attendance "updated" event.
     */
    public function updated(Attendance $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Attendance "deleted" event.
     */
    public function deleted(Attendance $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Attendance "restored" event.
     */
    public function restored(Attendance $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Attendance "forceDeleted" event.
     */
    public function forceDeleted(Attendance $modelVar): void
    {
        // ...
    }
}

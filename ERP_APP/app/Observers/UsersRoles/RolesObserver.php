<?php

namespace App\Observers\UsersRoles;

use App\Models\UsersRoles\Roles;

class RolesObserver
{
    /**
     * Handle the Roles "created" event.
     */
    public function created(Roles $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Roles "updated" event.
     */
    public function updated(Roles $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Roles "deleted" event.
     */
    public function deleted(Roles $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Roles "restored" event.
     */
    public function restored(Roles $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Roles "forceDeleted" event.
     */
    public function forceDeleted(Roles $modelVar): void
    {
        // ...
    }
}

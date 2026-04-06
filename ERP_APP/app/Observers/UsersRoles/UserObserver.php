<?php

namespace App\Observers\UsersRoles;

use App\Models\UsersRoles\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $modelVar): void
    {
        // ...
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $modelVar): void
    {
        // ...
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $modelVar): void
    {
        // ...
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $modelVar): void
    {
        // ...
    }

    /**
     * Handle the User "forceDeleted" event.
     */
    public function forceDeleted(User $modelVar): void
    {
        // ...
    }
}

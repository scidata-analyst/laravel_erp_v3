<?php

namespace App\Listeners\UsersRoles;

use App\Events\UsersRoles\RolesEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RolesListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RolesEvent $event): void
    {
        //
    }
}

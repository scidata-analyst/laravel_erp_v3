<?php

namespace App\Events\UsersRoles;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RolesEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        //
    }
}

<?php

namespace App\Events\Core;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DashboardEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        //
    }
}

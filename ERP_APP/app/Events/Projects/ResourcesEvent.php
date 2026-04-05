<?php

namespace App\Events\Projects;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ResourcesEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        //
    }
}

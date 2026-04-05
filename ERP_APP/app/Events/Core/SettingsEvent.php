<?php

namespace App\Events\Core;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SettingsEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        //
    }
}

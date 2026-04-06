<?php

namespace App\Events\HR;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AttendanceEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        // TODO: Add event properties
    }
}

<?php

namespace App\Events\Reports;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomReportsEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        //
    }
}

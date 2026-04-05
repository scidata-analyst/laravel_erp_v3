<?php

namespace App\Events\QualityControl;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ComplianceEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        //
    }
}

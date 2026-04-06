<?php

namespace App\Events\QualityControl;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DefectsEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        // TODO: Add event properties
    }
}

<?php

namespace App\Listeners\QualityControl;

use App\Events\QualityControl\DefectsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DefectsListener
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
    public function handle(DefectsEvent $event): void
    {
        //
    }
}

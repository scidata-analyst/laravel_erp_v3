<?php

namespace App\Listeners\QualityControl;

use App\Events\QualityControl\QcChecklistsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class QcChecklistsListener
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
    public function handle(QcChecklistsEvent $event): void
    {
        //
    }
}

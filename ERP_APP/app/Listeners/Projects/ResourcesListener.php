<?php

namespace App\Listeners\Projects;

use App\Events\Projects\ResourcesEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ResourcesListener
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
    public function handle(ResourcesEvent $event): void
    {
        //
    }
}

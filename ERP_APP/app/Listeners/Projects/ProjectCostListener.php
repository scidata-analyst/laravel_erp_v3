<?php

namespace App\Listeners\Projects;

use App\Events\Projects\ProjectCostEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProjectCostListener
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
    public function handle(ProjectCostEvent $event): void
    {
        //
    }
}

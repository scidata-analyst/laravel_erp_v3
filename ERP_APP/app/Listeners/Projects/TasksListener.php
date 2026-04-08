<?php

namespace App\Listeners\Projects;

use App\Events\Projects\TasksEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TasksListener
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
    public function handle(TasksEvent $event): void
    {
        //
    }
}

<?php

namespace App\Listeners\Documents;

use App\Events\Documents\DocLibraryEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DocLibraryListener
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
    public function handle(DocLibraryEvent $event): void
    {
        //
    }
}

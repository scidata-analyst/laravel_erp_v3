<?php

namespace App\Listeners\Documents;

use App\Events\Documents\DocVersionsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DocVersionsListener
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
    public function handle(DocVersionsEvent $event): void
    {
        //
    }
}

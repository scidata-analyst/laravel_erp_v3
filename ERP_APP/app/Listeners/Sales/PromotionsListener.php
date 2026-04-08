<?php

namespace App\Listeners\Sales;

use App\Events\Sales\PromotionsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PromotionsListener
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
    public function handle(PromotionsEvent $event): void
    {
        //
    }
}

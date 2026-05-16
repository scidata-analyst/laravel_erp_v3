<?php

namespace App\Listeners\Inventory;

use App\Events\Inventory\ProductCatalogEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProductCatalogListener
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
    public function handle(ProductCatalogEvent $event): void
    {
        //
    }
}

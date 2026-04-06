<?php

namespace App\Observers\Inventory;

use App\Models\Inventory\ProductCatalog;

class ProductCatalogObserver
{
    /**
     * Handle the ProductCatalog "created" event.
     */
    public function created(ProductCatalog $modelVar): void
    {
        // ...
    }

    /**
     * Handle the ProductCatalog "updated" event.
     */
    public function updated(ProductCatalog $modelVar): void
    {
        // ...
    }

    /**
     * Handle the ProductCatalog "deleted" event.
     */
    public function deleted(ProductCatalog $modelVar): void
    {
        // ...
    }

    /**
     * Handle the ProductCatalog "restored" event.
     */
    public function restored(ProductCatalog $modelVar): void
    {
        // ...
    }

    /**
     * Handle the ProductCatalog "forceDeleted" event.
     */
    public function forceDeleted(ProductCatalog $modelVar): void
    {
        // ...
    }
}

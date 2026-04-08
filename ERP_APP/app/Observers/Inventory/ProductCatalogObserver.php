<?php

namespace App\Observers\Inventory;

use App\Models\Inventory\ProductCatalog;

class ProductCatalogObserver
{
    /**
     * Handle the ProductCatalog "created" event.
     */
    public function created(ProductCatalog $productCatalog): void
    {
        //
    }

    /**
     * Handle the ProductCatalog "updated" event.
     */
    public function updated(ProductCatalog $productCatalog): void
    {
        //
    }

    /**
     * Handle the ProductCatalog "deleted" event.
     */
    public function deleted(ProductCatalog $productCatalog): void
    {
        //
    }

    /**
     * Handle the ProductCatalog "restored" event.
     */
    public function restored(ProductCatalog $productCatalog): void
    {
        //
    }

    /**
     * Handle the ProductCatalog "force deleted" event.
     */
    public function forceDeleted(ProductCatalog $productCatalog): void
    {
        //
    }
}

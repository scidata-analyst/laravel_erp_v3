<?php

namespace App\Observers\Production;

use App\Models\Production\WorkOrders;

class WorkOrdersObserver
{
    /**
     * Handle the WorkOrders "created" event.
     */
    public function created(WorkOrders $modelVar): void
    {
        // ...
    }

    /**
     * Handle the WorkOrders "updated" event.
     */
    public function updated(WorkOrders $modelVar): void
    {
        // ...
    }

    /**
     * Handle the WorkOrders "deleted" event.
     */
    public function deleted(WorkOrders $modelVar): void
    {
        // ...
    }

    /**
     * Handle the WorkOrders "restored" event.
     */
    public function restored(WorkOrders $modelVar): void
    {
        // ...
    }

    /**
     * Handle the WorkOrders "forceDeleted" event.
     */
    public function forceDeleted(WorkOrders $modelVar): void
    {
        // ...
    }
}

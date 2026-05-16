<?php

namespace App\Observers\Production;

use App\Models\Production\WorkOrders;

class WorkOrdersObserver
{
    /**
     * Handle the WorkOrders "created" event.
     */
    public function created(WorkOrders $workOrders): void
    {
        //
    }

    /**
     * Handle the WorkOrders "updated" event.
     */
    public function updated(WorkOrders $workOrders): void
    {
        //
    }

    /**
     * Handle the WorkOrders "deleted" event.
     */
    public function deleted(WorkOrders $workOrders): void
    {
        //
    }

    /**
     * Handle the WorkOrders "restored" event.
     */
    public function restored(WorkOrders $workOrders): void
    {
        //
    }

    /**
     * Handle the WorkOrders "force deleted" event.
     */
    public function forceDeleted(WorkOrders $workOrders): void
    {
        //
    }
}

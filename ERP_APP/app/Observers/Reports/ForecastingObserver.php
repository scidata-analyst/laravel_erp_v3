<?php

namespace App\Observers\Reports;

use App\Models\Reports\Forecasting;

class ForecastingObserver
{
    /**
     * Handle the Forecasting "created" event.
     */
    public function created(Forecasting $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Forecasting "updated" event.
     */
    public function updated(Forecasting $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Forecasting "deleted" event.
     */
    public function deleted(Forecasting $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Forecasting "restored" event.
     */
    public function restored(Forecasting $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Forecasting "forceDeleted" event.
     */
    public function forceDeleted(Forecasting $modelVar): void
    {
        // ...
    }
}

<?php

namespace App\Observers\Reports;

use App\Models\Reports\Forecasting;

class ForecastingObserver
{
    /**
     * Handle the Forecasting "created" event.
     */
    public function created(Forecasting $forecasting): void
    {
        //
    }

    /**
     * Handle the Forecasting "updated" event.
     */
    public function updated(Forecasting $forecasting): void
    {
        //
    }

    /**
     * Handle the Forecasting "deleted" event.
     */
    public function deleted(Forecasting $forecasting): void
    {
        //
    }

    /**
     * Handle the Forecasting "restored" event.
     */
    public function restored(Forecasting $forecasting): void
    {
        //
    }

    /**
     * Handle the Forecasting "force deleted" event.
     */
    public function forceDeleted(Forecasting $forecasting): void
    {
        //
    }
}

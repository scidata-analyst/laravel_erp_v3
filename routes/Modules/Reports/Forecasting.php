<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Reports\ForecastingController;

/**
 * =============================================================================
 * MODULE  : Reports
 * ENTITY  : Forecasting
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Reports/forecasting
 *
 * Structure:
 *   GET    /all    Fetch all records
 *   GET    /       Paginated list
 *   POST   /       Create record
 *   GET    /{id}   Show record
 *   PUT    /{id}   Update record
 *   DELETE /{id}   Delete record
 * =============================================================================
 */

Route::prefix('api/v1/reports/forecasting')->group(function () {

    
    Route::get('/all', [ForecastingController::class, 'all'])
        ->name('forecasting.all');

    
    Route::get('/', [ForecastingController::class, 'index'])
        ->name('forecasting.index');

    
    Route::post('/', [ForecastingController::class, 'store'])
        ->name('forecasting.store');

    
    Route::get('/{id}', [ForecastingController::class, 'show'])
        ->name('forecasting.show');

    
    Route::put('/{id}', [ForecastingController::class, 'update'])
        ->name('forecasting.update');

    
    Route::delete('/{id}', [ForecastingController::class, 'destroy'])
        ->name('forecasting.destroy');

});

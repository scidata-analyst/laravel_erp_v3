<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Reports\BiDashboardsController;

/**
 * =============================================================================
 * MODULE  : Reports
 * ENTITY  : BiDashboards
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Reports/bi-dashboards
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

Route::prefix('api/v1/reports/bi-dashboards')->group(function () {

    
    Route::get('/all', [BiDashboardsController::class, 'all'])
        ->name('bi_dashboards.all');

    
    Route::get('/', [BiDashboardsController::class, 'index'])
        ->name('bi_dashboards.index');

    
    Route::post('/', [BiDashboardsController::class, 'store'])
        ->name('bi_dashboards.store');

    
    Route::get('/{id}', [BiDashboardsController::class, 'show'])
        ->name('bi_dashboards.show');

    
    Route::put('/{id}', [BiDashboardsController::class, 'update'])
        ->name('bi_dashboards.update');

    
    Route::delete('/{id}', [BiDashboardsController::class, 'destroy'])
        ->name('bi_dashboards.destroy');

});

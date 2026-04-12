<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Core\DashboardController;

/**
 * =============================================================================
 * MODULE  : Core
 * ENTITY  : Dashboard
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Core/dashboard
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

Route::prefix('api/v1/core/dashboard')->group(function () {

    
    Route::get('/all', [DashboardController::class, 'all'])
        ->name('dashboard.all');

    
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard.index');

    
    Route::post('/', [DashboardController::class, 'store'])
        ->name('dashboard.store');

    
    Route::get('/{id}', [DashboardController::class, 'show'])
        ->name('dashboard.show');

    
    Route::put('/{id}', [DashboardController::class, 'update'])
        ->name('dashboard.update');

    
    Route::delete('/{id}', [DashboardController::class, 'destroy'])
        ->name('dashboard.destroy');

});

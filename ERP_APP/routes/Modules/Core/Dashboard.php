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

Route::prefix('api/v1/Core/dashboard')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [DashboardController::class, 'all'])
        ->name('dashboard.all');

    // Paginated list
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard.index');

    // Create
    Route::post('/', [DashboardController::class, 'store'])
        ->name('dashboard.store');

    // Show single
    Route::get('/{id}', [DashboardController::class, 'show'])
        ->name('dashboard.show');

    // Update
    Route::put('/{id}', [DashboardController::class, 'update'])
        ->name('dashboard.update');

    // Delete
    Route::delete('/{id}', [DashboardController::class, 'destroy'])
        ->name('dashboard.destroy');

});

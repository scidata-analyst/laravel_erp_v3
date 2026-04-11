<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HR\PerformanceController;

/**
 * =============================================================================
 * MODULE  : HR
 * ENTITY  : Performance
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/HR/performance
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

Route::prefix('api/v1/hr/performance')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [PerformanceController::class, 'all'])
        ->name('performance.all');

    // Paginated list
    Route::get('/', [PerformanceController::class, 'index'])
        ->name('performance.index');

    // Create
    Route::post('/', [PerformanceController::class, 'store'])
        ->name('performance.store');

    // Show single
    Route::get('/{id}', [PerformanceController::class, 'show'])
        ->name('performance.show');

    // Update
    Route::put('/{id}', [PerformanceController::class, 'update'])
        ->name('performance.update');

    // Delete
    Route::delete('/{id}', [PerformanceController::class, 'destroy'])
        ->name('performance.destroy');

});

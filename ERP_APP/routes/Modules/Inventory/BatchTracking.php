<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inventory\BatchTrackingController;

/**
 * =============================================================================
 * MODULE  : Inventory
 * ENTITY  : BatchTracking
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Inventory/batch-tracking
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

Route::prefix('api/v1/inventory/batch-tracking')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [BatchTrackingController::class, 'all'])
        ->name('batch_tracking.all');

    // Paginated list
    Route::get('/', [BatchTrackingController::class, 'index'])
        ->name('batch_tracking.index');

    // Create
    Route::post('/', [BatchTrackingController::class, 'store'])
        ->name('batch_tracking.store');

    // Show single
    Route::get('/{id}', [BatchTrackingController::class, 'show'])
        ->name('batch_tracking.show');

    // Update
    Route::put('/{id}', [BatchTrackingController::class, 'update'])
        ->name('batch_tracking.update');

    // Delete
    Route::delete('/{id}', [BatchTrackingController::class, 'destroy'])
        ->name('batch_tracking.destroy');

});

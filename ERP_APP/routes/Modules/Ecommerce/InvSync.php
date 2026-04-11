<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ecommerce\InvSyncController;

/**
 * =============================================================================
 * MODULE  : Ecommerce
 * ENTITY  : InvSync
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Ecommerce/inv-sync
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

Route::prefix('api/v1/ecommerce/inv-sync')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [InvSyncController::class, 'all'])
        ->name('inv_sync.all');

    // Paginated list
    Route::get('/', [InvSyncController::class, 'index'])
        ->name('inv_sync.index');

    // Create
    Route::post('/', [InvSyncController::class, 'store'])
        ->name('inv_sync.store');

    // Show single
    Route::get('/{id}', [InvSyncController::class, 'show'])
        ->name('inv_sync.show');

    // Update
    Route::put('/{id}', [InvSyncController::class, 'update'])
        ->name('inv_sync.update');

    // Delete
    Route::delete('/{id}', [InvSyncController::class, 'destroy'])
        ->name('inv_sync.destroy');

});

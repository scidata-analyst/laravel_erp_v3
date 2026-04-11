<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Logistics\ShipmentsController;

/**
 * =============================================================================
 * MODULE  : Logistics
 * ENTITY  : Shipments
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Logistics/shipments
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

Route::prefix('api/v1/logistics/shipments')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [ShipmentsController::class, 'all'])
        ->name('shipments.all');

    // Paginated list
    Route::get('/', [ShipmentsController::class, 'index'])
        ->name('shipments.index');

    // Create
    Route::post('/', [ShipmentsController::class, 'store'])
        ->name('shipments.store');

    // Show single
    Route::get('/{id}', [ShipmentsController::class, 'show'])
        ->name('shipments.show');

    // Update
    Route::put('/{id}', [ShipmentsController::class, 'update'])
        ->name('shipments.update');

    // Delete
    Route::delete('/{id}', [ShipmentsController::class, 'destroy'])
        ->name('shipments.destroy');

});

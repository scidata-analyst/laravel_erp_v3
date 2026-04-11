<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Logistics\WarehousesController;

/**
 * =============================================================================
 * MODULE  : Logistics
 * ENTITY  : Warehouses
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Logistics/warehouses
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

Route::prefix('api/v1/Logistics/warehouses')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [WarehousesController::class, 'all'])
        ->name('warehouses.all');

    // Paginated list
    Route::get('/', [WarehousesController::class, 'index'])
        ->name('warehouses.index');

    // Create
    Route::post('/', [WarehousesController::class, 'store'])
        ->name('warehouses.store');

    // Show single
    Route::get('/{id}', [WarehousesController::class, 'show'])
        ->name('warehouses.show');

    // Update
    Route::put('/{id}', [WarehousesController::class, 'update'])
        ->name('warehouses.update');

    // Delete
    Route::delete('/{id}', [WarehousesController::class, 'destroy'])
        ->name('warehouses.destroy');

});

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

Route::prefix('api/v1/logistics/warehouses')->group(function () {

    
    Route::get('/all', [WarehousesController::class, 'all'])
        ->name('warehouses.all');

    
    Route::get('/', [WarehousesController::class, 'index'])
        ->name('warehouses.index');

    
    Route::post('/', [WarehousesController::class, 'store'])
        ->name('warehouses.store');

    
    Route::get('/{id}', [WarehousesController::class, 'show'])
        ->name('warehouses.show');

    
    Route::put('/{id}', [WarehousesController::class, 'update'])
        ->name('warehouses.update');

    
    Route::delete('/{id}', [WarehousesController::class, 'destroy'])
        ->name('warehouses.destroy');

});

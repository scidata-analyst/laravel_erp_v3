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

    
    Route::get('/all', [ShipmentsController::class, 'all'])
        ->name('shipments.all');

    
    Route::get('/', [ShipmentsController::class, 'index'])
        ->name('shipments.index');

    
    Route::post('/', [ShipmentsController::class, 'store'])
        ->name('shipments.store');

    
    Route::get('/{id}', [ShipmentsController::class, 'show'])
        ->name('shipments.show');

    
    Route::put('/{id}', [ShipmentsController::class, 'update'])
        ->name('shipments.update');

    
    Route::delete('/{id}', [ShipmentsController::class, 'destroy'])
        ->name('shipments.destroy');

});

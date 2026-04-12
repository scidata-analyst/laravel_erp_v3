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

    
    Route::get('/all', [InvSyncController::class, 'all'])
        ->name('inv_sync.all');

    
    Route::get('/', [InvSyncController::class, 'index'])
        ->name('inv_sync.index');

    
    Route::post('/', [InvSyncController::class, 'store'])
        ->name('inv_sync.store');

    
    Route::get('/{id}', [InvSyncController::class, 'show'])
        ->name('inv_sync.show');

    
    Route::put('/{id}', [InvSyncController::class, 'update'])
        ->name('inv_sync.update');

    
    Route::delete('/{id}', [InvSyncController::class, 'destroy'])
        ->name('inv_sync.destroy');

});

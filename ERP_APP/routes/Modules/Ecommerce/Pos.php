<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ecommerce\PosController;

/**
 * =============================================================================
 * MODULE  : Ecommerce
 * ENTITY  : Pos
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Ecommerce/pos
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

Route::prefix('api/v1/Ecommerce/pos')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [PosController::class, 'all'])
        ->name('pos.all');

    // Paginated list
    Route::get('/', [PosController::class, 'index'])
        ->name('pos.index');

    // Create
    Route::post('/', [PosController::class, 'store'])
        ->name('pos.store');

    // Show single
    Route::get('/{id}', [PosController::class, 'show'])
        ->name('pos.show');

    // Update
    Route::put('/{id}', [PosController::class, 'update'])
        ->name('pos.update');

    // Delete
    Route::delete('/{id}', [PosController::class, 'destroy'])
        ->name('pos.destroy');

});

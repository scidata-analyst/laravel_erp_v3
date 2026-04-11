<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Production\BomController;

/**
 * =============================================================================
 * MODULE  : Production
 * ENTITY  : Bom
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Production/bom
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

Route::prefix('api/v1/Production/bom')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [BomController::class, 'all'])
        ->name('bom.all');

    // Paginated list
    Route::get('/', [BomController::class, 'index'])
        ->name('bom.index');

    // Create
    Route::post('/', [BomController::class, 'store'])
        ->name('bom.store');

    // Show single
    Route::get('/{id}', [BomController::class, 'show'])
        ->name('bom.show');

    // Update
    Route::put('/{id}', [BomController::class, 'update'])
        ->name('bom.update');

    // Delete
    Route::delete('/{id}', [BomController::class, 'destroy'])
        ->name('bom.destroy');

});

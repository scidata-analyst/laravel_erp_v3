<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Purchase\GrnController;

/**
 * =============================================================================
 * MODULE  : Purchase
 * ENTITY  : Grn
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Purchase/grn
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

Route::prefix('api/v1/Purchase/grn')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [GrnController::class, 'all'])
        ->name('grn.all');

    // Paginated list
    Route::get('/', [GrnController::class, 'index'])
        ->name('grn.index');

    // Create
    Route::post('/', [GrnController::class, 'store'])
        ->name('grn.store');

    // Show single
    Route::get('/{id}', [GrnController::class, 'show'])
        ->name('grn.show');

    // Update
    Route::put('/{id}', [GrnController::class, 'update'])
        ->name('grn.update');

    // Delete
    Route::delete('/{id}', [GrnController::class, 'destroy'])
        ->name('grn.destroy');

});

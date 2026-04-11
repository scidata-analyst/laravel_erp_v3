<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRM\InteractionsController;

/**
 * =============================================================================
 * MODULE  : CRM
 * ENTITY  : Interactions
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/CRM/interactions
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

Route::prefix('api/v1/CRM/interactions')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [InteractionsController::class, 'all'])
        ->name('interactions.all');

    // Paginated list
    Route::get('/', [InteractionsController::class, 'index'])
        ->name('interactions.index');

    // Create
    Route::post('/', [InteractionsController::class, 'store'])
        ->name('interactions.store');

    // Show single
    Route::get('/{id}', [InteractionsController::class, 'show'])
        ->name('interactions.show');

    // Update
    Route::put('/{id}', [InteractionsController::class, 'update'])
        ->name('interactions.update');

    // Delete
    Route::delete('/{id}', [InteractionsController::class, 'destroy'])
        ->name('interactions.destroy');

});

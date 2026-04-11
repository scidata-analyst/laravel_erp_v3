<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Projects\ResourcesController;

/**
 * =============================================================================
 * MODULE  : Projects
 * ENTITY  : Resources
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Projects/resources
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

Route::prefix('api/v1/Projects/resources')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [ResourcesController::class, 'all'])
        ->name('resources.all');

    // Paginated list
    Route::get('/', [ResourcesController::class, 'index'])
        ->name('resources.index');

    // Create
    Route::post('/', [ResourcesController::class, 'store'])
        ->name('resources.store');

    // Show single
    Route::get('/{id}', [ResourcesController::class, 'show'])
        ->name('resources.show');

    // Update
    Route::put('/{id}', [ResourcesController::class, 'update'])
        ->name('resources.update');

    // Delete
    Route::delete('/{id}', [ResourcesController::class, 'destroy'])
        ->name('resources.destroy');

});

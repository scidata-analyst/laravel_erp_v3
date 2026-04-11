<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Logistics\RoutesController;

/**
 * =============================================================================
 * MODULE  : Logistics
 * ENTITY  : Routes
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Logistics/routes
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

Route::prefix('api/v1/logistics/routes')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [RoutesController::class, 'all'])
        ->name('routes.all');

    // Paginated list
    Route::get('/', [RoutesController::class, 'index'])
        ->name('routes.index');

    // Create
    Route::post('/', [RoutesController::class, 'store'])
        ->name('routes.store');

    // Show single
    Route::get('/{id}', [RoutesController::class, 'show'])
        ->name('routes.show');

    // Update
    Route::put('/{id}', [RoutesController::class, 'update'])
        ->name('routes.update');

    // Delete
    Route::delete('/{id}', [RoutesController::class, 'destroy'])
        ->name('routes.destroy');

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Projects\ProjectCostController;

/**
 * =============================================================================
 * MODULE  : Projects
 * ENTITY  : ProjectCost
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Projects/project-cost
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

Route::prefix('api/v1/projects/project-cost')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [ProjectCostController::class, 'all'])
        ->name('project_cost.all');

    // Paginated list
    Route::get('/', [ProjectCostController::class, 'index'])
        ->name('project_cost.index');

    // Create
    Route::post('/', [ProjectCostController::class, 'store'])
        ->name('project_cost.store');

    // Show single
    Route::get('/{id}', [ProjectCostController::class, 'show'])
        ->name('project_cost.show');

    // Update
    Route::put('/{id}', [ProjectCostController::class, 'update'])
        ->name('project_cost.update');

    // Delete
    Route::delete('/{id}', [ProjectCostController::class, 'destroy'])
        ->name('project_cost.destroy');

});

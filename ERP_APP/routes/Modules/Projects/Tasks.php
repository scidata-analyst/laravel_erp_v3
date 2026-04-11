<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Projects\TasksController;

/**
 * =============================================================================
 * MODULE  : Projects
 * ENTITY  : Tasks
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Projects/tasks
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

Route::prefix('api/v1/projects/tasks')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [TasksController::class, 'all'])
        ->name('tasks.all');

    // Paginated list
    Route::get('/', [TasksController::class, 'index'])
        ->name('tasks.index');

    // Create
    Route::post('/', [TasksController::class, 'store'])
        ->name('tasks.store');

    // Show single
    Route::get('/{id}', [TasksController::class, 'show'])
        ->name('tasks.show');

    // Update
    Route::put('/{id}', [TasksController::class, 'update'])
        ->name('tasks.update');

    // Delete
    Route::delete('/{id}', [TasksController::class, 'destroy'])
        ->name('tasks.destroy');

});

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

    
    Route::get('/all', [TasksController::class, 'all'])
        ->name('tasks.all');

    
    Route::get('/', [TasksController::class, 'index'])
        ->name('tasks.index');

    
    Route::post('/', [TasksController::class, 'store'])
        ->name('tasks.store');

    
    Route::get('/{id}', [TasksController::class, 'show'])
        ->name('tasks.show');

    
    Route::put('/{id}', [TasksController::class, 'update'])
        ->name('tasks.update');

    
    Route::delete('/{id}', [TasksController::class, 'destroy'])
        ->name('tasks.destroy');

});

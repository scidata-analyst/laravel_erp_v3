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

Route::prefix('api/v1/projects/resources')->group(function () {

    
    Route::get('/all', [ResourcesController::class, 'all'])
        ->name('resources.all');

    
    Route::get('/', [ResourcesController::class, 'index'])
        ->name('resources.index');

    
    Route::post('/', [ResourcesController::class, 'store'])
        ->name('resources.store');

    
    Route::get('/{id}', [ResourcesController::class, 'show'])
        ->name('resources.show');

    
    Route::put('/{id}', [ResourcesController::class, 'update'])
        ->name('resources.update');

    
    Route::delete('/{id}', [ResourcesController::class, 'destroy'])
        ->name('resources.destroy');

});

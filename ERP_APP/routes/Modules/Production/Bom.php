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

Route::prefix('api/v1/production/bom')->group(function () {

    
    Route::get('/all', [BomController::class, 'all'])
        ->name('bom.all');

    
    Route::get('/', [BomController::class, 'index'])
        ->name('bom.index');

    
    Route::post('/', [BomController::class, 'store'])
        ->name('bom.store');

    
    Route::get('/{id}', [BomController::class, 'show'])
        ->name('bom.show');

    
    Route::put('/{id}', [BomController::class, 'update'])
        ->name('bom.update');

    
    Route::delete('/{id}', [BomController::class, 'destroy'])
        ->name('bom.destroy');

});

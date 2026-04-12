<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accounting\GlController;

/**
 * =============================================================================
 * MODULE  : Accounting
 * ENTITY  : Gl
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Accounting/gl
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

Route::prefix('api/v1/accounting/gl')->group(function () {

    
    Route::get('/all', [GlController::class, 'all'])
        ->name('gl.all');

    
    Route::get('/', [GlController::class, 'index'])
        ->name('gl.index');

    
    Route::post('/', [GlController::class, 'store'])
        ->name('gl.store');

    
    Route::get('/{id}', [GlController::class, 'show'])
        ->name('gl.show');

    
    Route::put('/{id}', [GlController::class, 'update'])
        ->name('gl.update');

    
    Route::delete('/{id}', [GlController::class, 'destroy'])
        ->name('gl.destroy');

});

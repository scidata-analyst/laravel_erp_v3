<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QualityControl\DefectsController;

/**
 * =============================================================================
 * MODULE  : QualityControl
 * ENTITY  : Defects
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/QualityControl/defects
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

Route::prefix('api/v1/qualitycontrol/defects')->group(function () {

    Route::get('/all', [DefectsController::class, 'all'])
        ->name('defects.all');


    Route::get('/', [DefectsController::class, 'index'])
        ->name('defects.index');

    
    Route::post('/', [DefectsController::class, 'store'])
        ->name('defects.store');

    
    Route::get('/{id}', [DefectsController::class, 'show'])
        ->name('defects.show');

    
    Route::put('/{id}', [DefectsController::class, 'update'])
        ->name('defects.update');

    
    Route::delete('/{id}', [DefectsController::class, 'destroy'])
        ->name('defects.destroy');

});

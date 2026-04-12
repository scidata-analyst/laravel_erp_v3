<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Production\MachineLaborController;

/**
 * =============================================================================
 * MODULE  : Production
 * ENTITY  : MachineLabor
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Production/machine-labor
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

Route::prefix('api/v1/production/machine-labor')->group(function () {

    
    Route::get('/all', [MachineLaborController::class, 'all'])
        ->name('machine_labor.all');

    
    Route::get('/', [MachineLaborController::class, 'index'])
        ->name('machine_labor.index');

    
    Route::post('/', [MachineLaborController::class, 'store'])
        ->name('machine_labor.store');

    
    Route::get('/{id}', [MachineLaborController::class, 'show'])
        ->name('machine_labor.show');

    
    Route::put('/{id}', [MachineLaborController::class, 'update'])
        ->name('machine_labor.update');

    
    Route::delete('/{id}', [MachineLaborController::class, 'destroy'])
        ->name('machine_labor.destroy');

});

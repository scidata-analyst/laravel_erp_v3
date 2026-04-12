<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QualityControl\QcChecklistsController;

/**
 * =============================================================================
 * MODULE  : QualityControl
 * ENTITY  : QcChecklists
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/QualityControl/qc-checklists
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

Route::prefix('api/v1/qualitycontrol/qc-checklists')->group(function () {

    
    Route::get('/all', [QcChecklistsController::class, 'all'])
        ->name('qc_checklists.all');

    
    Route::get('/', [QcChecklistsController::class, 'index'])
        ->name('qc_checklists.index');

    
    Route::post('/', [QcChecklistsController::class, 'store'])
        ->name('qc_checklists.store');

    
    Route::get('/{id}', [QcChecklistsController::class, 'show'])
        ->name('qc_checklists.show');

    
    Route::put('/{id}', [QcChecklistsController::class, 'update'])
        ->name('qc_checklists.update');

    
    Route::delete('/{id}', [QcChecklistsController::class, 'destroy'])
        ->name('qc_checklists.destroy');

});

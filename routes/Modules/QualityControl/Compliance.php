<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QualityControl\ComplianceController;

/**
 * =============================================================================
 * MODULE  : QualityControl
 * ENTITY  : Compliance
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/QualityControl/compliance
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

Route::prefix('api/v1/qualitycontrol/compliance')->group(function () {

    
    Route::get('/all', [ComplianceController::class, 'all'])
        ->name('compliance.all');

    
    Route::get('/', [ComplianceController::class, 'index'])
        ->name('compliance.index');

    
    Route::post('/', [ComplianceController::class, 'store'])
        ->name('compliance.store');

    
    Route::get('/{id}', [ComplianceController::class, 'show'])
        ->name('compliance.show');

    
    Route::put('/{id}', [ComplianceController::class, 'update'])
        ->name('compliance.update');

    
    Route::delete('/{id}', [ComplianceController::class, 'destroy'])
        ->name('compliance.destroy');

});

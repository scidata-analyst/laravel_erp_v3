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

Route::prefix('api/v1/QualityControl/compliance')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [ComplianceController::class, 'all'])
        ->name('compliance.all');

    // Paginated list
    Route::get('/', [ComplianceController::class, 'index'])
        ->name('compliance.index');

    // Create
    Route::post('/', [ComplianceController::class, 'store'])
        ->name('compliance.store');

    // Show single
    Route::get('/{id}', [ComplianceController::class, 'show'])
        ->name('compliance.show');

    // Update
    Route::put('/{id}', [ComplianceController::class, 'update'])
        ->name('compliance.update');

    // Delete
    Route::delete('/{id}', [ComplianceController::class, 'destroy'])
        ->name('compliance.destroy');

});

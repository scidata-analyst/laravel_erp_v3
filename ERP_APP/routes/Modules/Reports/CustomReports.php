<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Reports\CustomReportsController;

/**
 * =============================================================================
 * MODULE  : Reports
 * ENTITY  : CustomReports
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Reports/custom-reports
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

Route::prefix('api/v1/Reports/custom-reports')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [CustomReportsController::class, 'all'])
        ->name('custom_reports.all');

    // Paginated list
    Route::get('/', [CustomReportsController::class, 'index'])
        ->name('custom_reports.index');

    // Create
    Route::post('/', [CustomReportsController::class, 'store'])
        ->name('custom_reports.store');

    // Show single
    Route::get('/{id}', [CustomReportsController::class, 'show'])
        ->name('custom_reports.show');

    // Update
    Route::put('/{id}', [CustomReportsController::class, 'update'])
        ->name('custom_reports.update');

    // Delete
    Route::delete('/{id}', [CustomReportsController::class, 'destroy'])
        ->name('custom_reports.destroy');

});

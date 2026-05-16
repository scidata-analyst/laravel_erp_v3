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

Route::prefix('api/v1/reports/custom-reports')->group(function () {

    
    Route::get('/all', [CustomReportsController::class, 'all'])
        ->name('custom_reports.all');

    
    Route::get('/', [CustomReportsController::class, 'index'])
        ->name('custom_reports.index');

    
    Route::post('/', [CustomReportsController::class, 'store'])
        ->name('custom_reports.store');

    
    Route::get('/{id}', [CustomReportsController::class, 'show'])
        ->name('custom_reports.show');

    
    Route::put('/{id}', [CustomReportsController::class, 'update'])
        ->name('custom_reports.update');

    
    Route::delete('/{id}', [CustomReportsController::class, 'destroy'])
        ->name('custom_reports.destroy');

});

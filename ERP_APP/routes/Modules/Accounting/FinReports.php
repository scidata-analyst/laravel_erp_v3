<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accounting\FinReportsController;

/**
 * =============================================================================
 * MODULE  : Accounting
 * ENTITY  : FinReports
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Accounting/fin-reports
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

Route::prefix('api/v1/accounting/fin-reports')->group(function () {

    
    Route::get('/all', [FinReportsController::class, 'all'])
        ->name('fin_reports.all');

    
    Route::get('/', [FinReportsController::class, 'index'])
        ->name('fin_reports.index');

    
    Route::post('/', [FinReportsController::class, 'store'])
        ->name('fin_reports.store');

    
    Route::get('/{id}', [FinReportsController::class, 'show'])
        ->name('fin_reports.show');

    
    Route::put('/{id}', [FinReportsController::class, 'update'])
        ->name('fin_reports.update');

    
    Route::delete('/{id}', [FinReportsController::class, 'destroy'])
        ->name('fin_reports.destroy');

});

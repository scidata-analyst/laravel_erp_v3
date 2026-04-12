<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HR\PayrollController;

/**
 * =============================================================================
 * MODULE  : HR
 * ENTITY  : Payroll
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/HR/payroll
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

Route::prefix('api/v1/hr/payroll')->group(function () {

    
    Route::get('/all', [PayrollController::class, 'all'])
        ->name('payroll.all');

    
    Route::get('/', [PayrollController::class, 'index'])
        ->name('payroll.index');

    
    Route::post('/', [PayrollController::class, 'store'])
        ->name('payroll.store');

    
    Route::get('/{id}', [PayrollController::class, 'show'])
        ->name('payroll.show');

    
    Route::put('/{id}', [PayrollController::class, 'update'])
        ->name('payroll.update');

    
    Route::delete('/{id}', [PayrollController::class, 'destroy'])
        ->name('payroll.destroy');

});

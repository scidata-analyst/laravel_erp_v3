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

Route::prefix('api/v1/HR/payroll')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [PayrollController::class, 'all'])
        ->name('payroll.all');

    // Paginated list
    Route::get('/', [PayrollController::class, 'index'])
        ->name('payroll.index');

    // Create
    Route::post('/', [PayrollController::class, 'store'])
        ->name('payroll.store');

    // Show single
    Route::get('/{id}', [PayrollController::class, 'show'])
        ->name('payroll.show');

    // Update
    Route::put('/{id}', [PayrollController::class, 'update'])
        ->name('payroll.update');

    // Delete
    Route::delete('/{id}', [PayrollController::class, 'destroy'])
        ->name('payroll.destroy');

});

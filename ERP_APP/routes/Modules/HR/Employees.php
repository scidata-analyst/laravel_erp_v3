<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HR\EmployeesController;

/**
 * =============================================================================
 * MODULE  : HR
 * ENTITY  : Employees
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/HR/employees
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

Route::prefix('api/v1/hr/employees')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [EmployeesController::class, 'all'])
        ->name('employees.all');

    // Paginated list
    Route::get('/', [EmployeesController::class, 'index'])
        ->name('employees.index');

    // Create
    Route::post('/', [EmployeesController::class, 'store'])
        ->name('employees.store');

    // Show single
    Route::get('/{id}', [EmployeesController::class, 'show'])
        ->name('employees.show');

    // Update
    Route::put('/{id}', [EmployeesController::class, 'update'])
        ->name('employees.update');

    // Delete
    Route::delete('/{id}', [EmployeesController::class, 'destroy'])
        ->name('employees.destroy');

});

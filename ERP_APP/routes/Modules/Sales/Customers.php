<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sales\CustomersController;

/**
 * =============================================================================
 * MODULE  : Sales
 * ENTITY  : Customers
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Sales/customers
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

Route::prefix('api/v1/sales/customers')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [CustomersController::class, 'all'])
        ->name('customers.all');

    // Paginated list
    Route::get('/', [CustomersController::class, 'index'])
        ->name('customers.index');

    // Create
    Route::post('/', [CustomersController::class, 'store'])
        ->name('customers.store');

    // Show single
    Route::get('/{id}', [CustomersController::class, 'show'])
        ->name('customers.show');

    // Update
    Route::put('/{id}', [CustomersController::class, 'update'])
        ->name('customers.update');

    // Delete
    Route::delete('/{id}', [CustomersController::class, 'destroy'])
        ->name('customers.destroy');

});

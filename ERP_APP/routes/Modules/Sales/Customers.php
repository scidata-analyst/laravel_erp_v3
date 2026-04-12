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

    
    Route::get('/all', [CustomersController::class, 'all'])
        ->name('customers.all');

    
    Route::get('/', [CustomersController::class, 'index'])
        ->name('customers.index');

    
    Route::post('/', [CustomersController::class, 'store'])
        ->name('customers.store');

    
    Route::get('/{id}', [CustomersController::class, 'show'])
        ->name('customers.show');

    
    Route::put('/{id}', [CustomersController::class, 'update'])
        ->name('customers.update');

    
    Route::delete('/{id}', [CustomersController::class, 'destroy'])
        ->name('customers.destroy');

});

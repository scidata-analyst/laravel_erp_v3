<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sales\SalesOrdersController;

/**
 * =============================================================================
 * MODULE  : Sales
 * ENTITY  : SalesOrders
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Sales/sales-orders
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

Route::prefix('api/v1/sales/sales-orders')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [SalesOrdersController::class, 'all'])
        ->name('sales_orders.all');

    // Paginated list
    Route::get('/', [SalesOrdersController::class, 'index'])
        ->name('sales_orders.index');

    // Create
    Route::post('/', [SalesOrdersController::class, 'store'])
        ->name('sales_orders.store');

    // Show single
    Route::get('/{id}', [SalesOrdersController::class, 'show'])
        ->name('sales_orders.show');

    // Update
    Route::put('/{id}', [SalesOrdersController::class, 'update'])
        ->name('sales_orders.update');

    // Delete
    Route::delete('/{id}', [SalesOrdersController::class, 'destroy'])
        ->name('sales_orders.destroy');

});

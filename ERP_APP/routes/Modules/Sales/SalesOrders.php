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

    
    Route::get('/all', [SalesOrdersController::class, 'all'])
        ->name('sales_orders.all');

    
    Route::get('/', [SalesOrdersController::class, 'index'])
        ->name('sales_orders.index');

    
    Route::post('/', [SalesOrdersController::class, 'store'])
        ->name('sales_orders.store');

    
    Route::get('/{id}', [SalesOrdersController::class, 'show'])
        ->name('sales_orders.show');

    
    Route::put('/{id}', [SalesOrdersController::class, 'update'])
        ->name('sales_orders.update');

    
    Route::delete('/{id}', [SalesOrdersController::class, 'destroy'])
        ->name('sales_orders.destroy');

});

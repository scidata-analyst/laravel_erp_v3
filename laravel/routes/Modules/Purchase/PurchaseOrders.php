<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Purchase\PurchaseOrdersController;

/**
 * =============================================================================
 * MODULE  : Purchase
 * ENTITY  : PurchaseOrders
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Purchase/purchase-orders
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

Route::prefix('api/v1/purchase/purchase-orders')->group(function () {

    
    Route::get('/all', [PurchaseOrdersController::class, 'all'])
        ->name('purchase_orders.all');

    
    Route::get('/', [PurchaseOrdersController::class, 'index'])
        ->name('purchase_orders.index');

    
    Route::post('/', [PurchaseOrdersController::class, 'store'])
        ->name('purchase_orders.store');

    
    Route::get('/{id}', [PurchaseOrdersController::class, 'show'])
        ->name('purchase_orders.show');

    
    Route::put('/{id}', [PurchaseOrdersController::class, 'update'])
        ->name('purchase_orders.update');

    
    Route::delete('/{id}', [PurchaseOrdersController::class, 'destroy'])
        ->name('purchase_orders.destroy');

});

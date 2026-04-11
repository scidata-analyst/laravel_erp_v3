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

Route::prefix('api/v1/Purchase/purchase-orders')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [PurchaseOrdersController::class, 'all'])
        ->name('purchase_orders.all');

    // Paginated list
    Route::get('/', [PurchaseOrdersController::class, 'index'])
        ->name('purchase_orders.index');

    // Create
    Route::post('/', [PurchaseOrdersController::class, 'store'])
        ->name('purchase_orders.store');

    // Show single
    Route::get('/{id}', [PurchaseOrdersController::class, 'show'])
        ->name('purchase_orders.show');

    // Update
    Route::put('/{id}', [PurchaseOrdersController::class, 'update'])
        ->name('purchase_orders.update');

    // Delete
    Route::delete('/{id}', [PurchaseOrdersController::class, 'destroy'])
        ->name('purchase_orders.destroy');

});

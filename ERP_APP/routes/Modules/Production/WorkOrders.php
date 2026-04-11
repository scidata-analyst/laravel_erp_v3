<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Production\WorkOrdersController;

/**
 * =============================================================================
 * MODULE  : Production
 * ENTITY  : WorkOrders
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Production/work-orders
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

Route::prefix('api/v1/Production/work-orders')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [WorkOrdersController::class, 'all'])
        ->name('work_orders.all');

    // Paginated list
    Route::get('/', [WorkOrdersController::class, 'index'])
        ->name('work_orders.index');

    // Create
    Route::post('/', [WorkOrdersController::class, 'store'])
        ->name('work_orders.store');

    // Show single
    Route::get('/{id}', [WorkOrdersController::class, 'show'])
        ->name('work_orders.show');

    // Update
    Route::put('/{id}', [WorkOrdersController::class, 'update'])
        ->name('work_orders.update');

    // Delete
    Route::delete('/{id}', [WorkOrdersController::class, 'destroy'])
        ->name('work_orders.destroy');

});

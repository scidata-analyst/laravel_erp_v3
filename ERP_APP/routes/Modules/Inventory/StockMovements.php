<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inventory\StockMovementsController;

/**
 * =============================================================================
 * MODULE  : Inventory
 * ENTITY  : StockMovements
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Inventory/stock-movements
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

Route::prefix('api/v1/Inventory/stock-movements')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [StockMovementsController::class, 'all'])
        ->name('stock_movements.all');

    // Paginated list
    Route::get('/', [StockMovementsController::class, 'index'])
        ->name('stock_movements.index');

    // Create
    Route::post('/', [StockMovementsController::class, 'store'])
        ->name('stock_movements.store');

    // Show single
    Route::get('/{id}', [StockMovementsController::class, 'show'])
        ->name('stock_movements.show');

    // Update
    Route::put('/{id}', [StockMovementsController::class, 'update'])
        ->name('stock_movements.update');

    // Delete
    Route::delete('/{id}', [StockMovementsController::class, 'destroy'])
        ->name('stock_movements.destroy');

});

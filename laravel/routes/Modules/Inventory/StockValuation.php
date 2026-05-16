<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inventory\StockValuationController;

/**
 * =============================================================================
 * MODULE  : Inventory
 * ENTITY  : StockValuation
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Inventory/stock-valuation
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

Route::prefix('api/v1/inventory/stock-valuation')->group(function () {

    
    Route::get('/all', [StockValuationController::class, 'all'])
        ->name('stock_valuation.all');

    
    Route::get('/', [StockValuationController::class, 'index'])
        ->name('stock_valuation.index');

    
    Route::post('/', [StockValuationController::class, 'store'])
        ->name('stock_valuation.store');

    
    Route::get('/{id}', [StockValuationController::class, 'show'])
        ->name('stock_valuation.show');

    
    Route::put('/{id}', [StockValuationController::class, 'update'])
        ->name('stock_valuation.update');

    
    Route::delete('/{id}', [StockValuationController::class, 'destroy'])
        ->name('stock_valuation.destroy');

});

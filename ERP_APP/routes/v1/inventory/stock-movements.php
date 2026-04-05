<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Inventory\StockMovementsController;

Route::prefix('inventory/stock-movements')->name('inventory.stock-movements.')->group(function () {
    Route::get('/', function (Request $request, StockMovementsController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.inventory.stock-movements');
    })->name('index');
    Route::post('/', [StockMovementsController::class, 'store'])->name('store');
    Route::get('/product/{productId}', [StockMovementsController::class, 'getByProduct'])->name('by-product');
    Route::get('/{id}', [StockMovementsController::class, 'show'])->name('show');
});

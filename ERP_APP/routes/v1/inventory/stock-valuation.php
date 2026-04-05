<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Inventory\StockValuationController;

Route::prefix('inventory/stock-valuation')->name('inventory.stock-valuation.')->group(function () {
    Route::get('/', function (Request $request, StockValuationController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.inventory.stock-valuation');
    })->name('index');
    Route::post('/', [StockValuationController::class, 'store'])->name('store');
    Route::get('/product/{productId}', [StockValuationController::class, 'getLatestByProduct'])->name('latest-by-product');
    Route::get('/{id}', [StockValuationController::class, 'show'])->name('show');
});

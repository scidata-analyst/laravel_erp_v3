<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Inventory\ProductCatalogController;

Route::prefix('inventory/products')->name('inventory.products.')->group(function () {
    Route::get('/', function (Request $request, ProductCatalogController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.inventory.products');
    })->name('index');
    Route::post('/', [ProductCatalogController::class, 'store'])->name('store');
    Route::get('/low-stock', [ProductCatalogController::class, 'getLowStockProducts'])->name('low-stock');
    Route::get('/stats', [ProductCatalogController::class, 'getProductStats'])->name('stats');
    Route::get('/{id}', [ProductCatalogController::class, 'show'])->name('show');
    Route::put('/{id}', [ProductCatalogController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProductCatalogController::class, 'destroy'])->name('destroy');
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Purchase\PurchaseOrdersController;

Route::prefix('purchase/purchase-orders')->name('purchase.purchase-orders.')->group(function () {
    Route::get('/', function (Request $request, PurchaseOrdersController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.purchase.purchase-orders');
    })->name('index');
    Route::post('/', [PurchaseOrdersController::class, 'store'])->name('store');
    Route::get('/{id}', [PurchaseOrdersController::class, 'show'])->name('show');
    Route::put('/{id}', [PurchaseOrdersController::class, 'update'])->name('update');
    Route::put('/{id}/status', [PurchaseOrdersController::class, 'updateStatus'])->name('update-status');
    Route::post('/{id}/receive', [PurchaseOrdersController::class, 'receive'])->name('receive');
});

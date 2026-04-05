<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Sales\SalesOrdersController;

Route::prefix('sales/sales-orders')->name('sales.sales-orders.')->group(function () {
    Route::get('/', function (Request $request, SalesOrdersController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.sales.sales-orders');
    })->name('index');
    Route::post('/', [SalesOrdersController::class, 'store'])->name('store');
    Route::get('/{id}', [SalesOrdersController::class, 'show'])->name('show');
    Route::put('/{id}', [SalesOrdersController::class, 'update'])->name('update');
    Route::delete('/{id}', [SalesOrdersController::class, 'destroy'])->name('destroy');
    Route::put('/{id}/status', [SalesOrdersController::class, 'updateStatus'])->name('update-status');
    Route::post('/{id}/cancel', [SalesOrdersController::class, 'cancel'])->name('cancel');
});

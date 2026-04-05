<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Purchase\SupplierPaymentsController;

Route::prefix('purchase/supplier-payments')->name('purchase.supplier-payments.')->group(function () {
    Route::get('/', function (Request $request, SupplierPaymentsController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.purchase.supplier-payments');
    })->name('index');
    Route::post('/', [SupplierPaymentsController::class, 'store'])->name('store');
    Route::get('/{id}', [SupplierPaymentsController::class, 'show'])->name('show');
    Route::put('/{id}', [SupplierPaymentsController::class, 'update'])->name('update');
    Route::delete('/{id}', [SupplierPaymentsController::class, 'destroy'])->name('destroy');
});

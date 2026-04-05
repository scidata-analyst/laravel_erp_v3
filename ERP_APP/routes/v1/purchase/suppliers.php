<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Purchase\SuppliersController;

Route::prefix('purchase/suppliers')->name('purchase.suppliers.')->group(function () {
    Route::get('/', function (Request $request, SuppliersController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.purchase.suppliers');
    })->name('index');
    Route::post('/', [SuppliersController::class, 'store'])->name('store');
    Route::get('/{id}', [SuppliersController::class, 'show'])->name('show');
    Route::put('/{id}', [SuppliersController::class, 'update'])->name('update');
    Route::delete('/{id}', [SuppliersController::class, 'destroy'])->name('destroy');
});

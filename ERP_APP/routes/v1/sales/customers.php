<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Sales\CustomersController;

Route::prefix('sales/customers')->name('sales.customers.')->group(function () {
    Route::get('/', function (Request $request, CustomersController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.sales.customers');
    })->name('index');
    Route::post('/', [CustomersController::class, 'store'])->name('store');
    Route::get('/stats', [CustomersController::class, 'getStats'])->name('stats');
    Route::get('/{id}', [CustomersController::class, 'show'])->name('show');
    Route::put('/{id}', [CustomersController::class, 'update'])->name('update');
    Route::delete('/{id}', [CustomersController::class, 'destroy'])->name('destroy');
});

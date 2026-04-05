<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Sales\DiscountsController;

Route::prefix('sales/discounts')->name('sales.discounts.')->group(function () {
    Route::get('/', function (Request $request, DiscountsController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.sales.discounts');
    })->name('index');
    Route::post('/', [DiscountsController::class, 'store'])->name('store');
    Route::post('/validate-code', [DiscountsController::class, 'validateCode'])->name('validate-code');
    Route::get('/{id}', [DiscountsController::class, 'show'])->name('show');
    Route::put('/{id}', [DiscountsController::class, 'update'])->name('update');
    Route::delete('/{id}', [DiscountsController::class, 'destroy'])->name('destroy');
});

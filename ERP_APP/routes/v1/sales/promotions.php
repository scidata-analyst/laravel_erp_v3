<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Sales\PromotionsController;

Route::prefix('sales/promotions')->name('sales.promotions.')->group(function () {
    Route::get('/', function (Request $request, PromotionsController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.sales.promotions');
    })->name('index');
    Route::post('/', [PromotionsController::class, 'store'])->name('store');
    Route::get('/active', [PromotionsController::class, 'getActive'])->name('active');
    Route::get('/{id}', [PromotionsController::class, 'show'])->name('show');
    Route::put('/{id}', [PromotionsController::class, 'update'])->name('update');
    Route::delete('/{id}', [PromotionsController::class, 'destroy'])->name('destroy');
});

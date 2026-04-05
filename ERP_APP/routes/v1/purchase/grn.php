<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Purchase\GrnController;

Route::prefix('purchase/grn')->name('purchase.grn.')->group(function () {
    Route::get('/', function (Request $request, GrnController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.purchase.grn');
    })->name('index');
    Route::post('/', [GrnController::class, 'store'])->name('store');
    Route::get('/{id}', [GrnController::class, 'show'])->name('show');
    Route::put('/{id}', [GrnController::class, 'update'])->name('update');
    Route::delete('/{id}', [GrnController::class, 'destroy'])->name('destroy');
});

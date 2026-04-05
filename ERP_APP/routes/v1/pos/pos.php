<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Ecommerce\PosController;

Route::prefix('pos/pos')->name('pos.pos.')->group(function () {
    Route::get('/', function (Request $request, PosController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.pos.pos');
    })->name('index');
    Route::post('/', [PosController::class, 'store'])->name('store');
    Route::get('/{id}', [PosController::class, 'show'])->name('show');
    Route::put('/{id}', [PosController::class, 'update'])->name('update');
    Route::delete('/{id}', [PosController::class, 'destroy'])->name('destroy');
    Route::get('/daily-summary', [PosController::class, 'dailySummary'])->name('daily-summary');
});

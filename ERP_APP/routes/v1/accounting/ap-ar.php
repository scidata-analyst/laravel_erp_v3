<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Accounting\ApArController;

Route::prefix('accounting/ap-ar')->name('accounting.ap-ar.')->group(function () {
    Route::get('/', function (Request $request, ApArController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.accounting.ap-ar');
    })->name('index');
    Route::post('/', [ApArController::class, 'store'])->name('store');
    Route::get('/balance/{partyName}', [ApArController::class, 'getBalance'])->name('balance');
    Route::get('/{id}', [ApArController::class, 'show'])->name('show');
    Route::put('/{id}', [ApArController::class, 'update'])->name('update');
    Route::delete('/{id}', [ApArController::class, 'destroy'])->name('destroy');
});

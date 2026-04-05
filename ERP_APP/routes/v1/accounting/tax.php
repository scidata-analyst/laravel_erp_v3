<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Accounting\TaxController;

Route::prefix('accounting/tax')->name('accounting.tax.')->group(function () {
    Route::get('/', function (Request $request, TaxController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.accounting.tax');
    })->name('index');
    Route::post('/', [TaxController::class, 'store'])->name('store');
    Route::get('/{id}', [TaxController::class, 'show'])->name('show');
    Route::put('/{id}', [TaxController::class, 'update'])->name('update');
    Route::delete('/{id}', [TaxController::class, 'destroy'])->name('destroy');
    Route::post('/calculate', [TaxController::class, 'calculate'])->name('calculate');
});

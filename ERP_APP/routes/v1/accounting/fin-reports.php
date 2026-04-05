<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Accounting\FinReportsController;

Route::prefix('accounting/fin-reports')->name('accounting.fin-reports.')->group(function () {
    Route::get('/', function (Request $request, FinReportsController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.accounting.fin-reports');
    })->name('index');
    Route::post('/', [FinReportsController::class, 'store'])->name('store');
    Route::get('/{id}', [FinReportsController::class, 'show'])->name('show');
    Route::delete('/{id}', [FinReportsController::class, 'destroy'])->name('destroy');
});

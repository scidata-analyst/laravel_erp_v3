<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Reports\CustomReportsController;

Route::prefix('report/custom-reports')->name('report.custom-reports.')->group(function () {
    Route::get('/', function (Request $request, CustomReportsController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.report.custom-reports');
    })->name('index');
    Route::post('/', [CustomReportsController::class, 'store'])->name('store');
    Route::get('/{id}', [CustomReportsController::class, 'show'])->name('show');
    Route::put('/{id}', [CustomReportsController::class, 'update'])->name('update');
    Route::delete('/{id}', [CustomReportsController::class, 'destroy'])->name('destroy');
});

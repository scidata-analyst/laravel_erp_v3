<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HR\PerformanceController;

Route::prefix('hr/performance')->name('hr.performance.')->group(function () {
    Route::get('/', function (Request $request, PerformanceController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.hr.performance');
    })->name('index');
    Route::post('/', [PerformanceController::class, 'store'])->name('store');
    Route::get('/{id}', [PerformanceController::class, 'show'])->name('show');
    Route::put('/{id}', [PerformanceController::class, 'update'])->name('update');
    Route::delete('/{id}', [PerformanceController::class, 'destroy'])->name('destroy');
});

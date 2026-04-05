<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Reports\ForecastingController;

Route::prefix('report/forecasting')->name('report.forecasting.')->group(function () {
    Route::get('/', function (Request $request, ForecastingController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.report.forecasting');
    })->name('index');
    Route::post('/', [ForecastingController::class, 'store'])->name('store');
    Route::get('/{id}', [ForecastingController::class, 'show'])->name('show');
    Route::put('/{id}', [ForecastingController::class, 'update'])->name('update');
    Route::delete('/{id}', [ForecastingController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/run', [ForecastingController::class, 'run'])->name('run');
});

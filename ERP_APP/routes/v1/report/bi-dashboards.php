<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Reports\BiDashboardsController;

Route::prefix('report/bi-dashboards')->name('report.bi-dashboards.')->group(function () {
    Route::get('/', function (Request $request, BiDashboardsController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.report.bi-dashboards');
    })->name('index');
    Route::post('/', [BiDashboardsController::class, 'store'])->name('store');
    Route::get('/user', [BiDashboardsController::class, 'userDashboards'])->name('user');
    Route::get('/{id}', [BiDashboardsController::class, 'show'])->name('show');
    Route::put('/{id}', [BiDashboardsController::class, 'update'])->name('update');
    Route::delete('/{id}', [BiDashboardsController::class, 'destroy'])->name('destroy');
});

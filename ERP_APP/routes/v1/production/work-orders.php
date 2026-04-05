<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Production\WorkOrdersController;

Route::prefix('production/work-orders')->name('production.work-orders.')->group(function () {
    Route::get('/', function (Request $request, WorkOrdersController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.production.work-orders');
    })->name('index');
    Route::post('/', [WorkOrdersController::class, 'store'])->name('store');
    Route::get('/{id}', [WorkOrdersController::class, 'show'])->name('show');
    Route::put('/{id}', [WorkOrdersController::class, 'update'])->name('update');
    Route::delete('/{id}', [WorkOrdersController::class, 'destroy'])->name('destroy');
    Route::put('/{id}/progress', [WorkOrdersController::class, 'updateProgress'])->name('update-progress');
});

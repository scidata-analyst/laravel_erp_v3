<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Logistics\ShipmentsController;

Route::prefix('warehouse/shipments')->name('warehouse.shipments.')->group(function () {
    Route::get('/', function (Request $request, ShipmentsController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.warehouse.shipments');
    })->name('index');
    Route::post('/', [ShipmentsController::class, 'store'])->name('store');
    Route::get('/{id}', [ShipmentsController::class, 'show'])->name('show');
    Route::put('/{id}', [ShipmentsController::class, 'update'])->name('update');
    Route::delete('/{id}', [ShipmentsController::class, 'destroy'])->name('destroy');
    Route::put('/{id}/status', [ShipmentsController::class, 'updateStatus'])->name('update-status');
});

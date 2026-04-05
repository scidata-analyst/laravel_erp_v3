<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Logistics\WarehousesController;

Route::prefix('warehouse/warehouses')->name('warehouse.warehouses.')->group(function () {
    Route::get('/', function (Request $request, WarehousesController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.warehouse.warehouses');
    })->name('index');
    Route::post('/', [WarehousesController::class, 'store'])->name('store');
    Route::get('/{id}', [WarehousesController::class, 'show'])->name('show');
    Route::put('/{id}', [WarehousesController::class, 'update'])->name('update');
    Route::delete('/{id}', [WarehousesController::class, 'destroy'])->name('destroy');
});

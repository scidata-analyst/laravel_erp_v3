<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Logistics\RoutesController;

Route::prefix('warehouse/routes')->name('warehouse.routes.')->group(function () {
    Route::get('/', function () { return view('pages.warehouse.routes'); })->name('index');
    Route::post('/', [RoutesController::class, 'store'])->name('store');
    Route::get('/{id}', [RoutesController::class, 'show'])->name('show');
});

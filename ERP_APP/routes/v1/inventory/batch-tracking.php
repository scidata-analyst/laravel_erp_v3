<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inventory\BatchTrackingController;

Route::prefix('inventory/batch-tracking')->name('inventory.batch-tracking.')->group(function () {
    Route::get('/', function () { return view('pages.inventory.batch-tracking'); })->name('index');
    Route::post('/', [BatchTrackingController::class, 'store'])->name('store');
    Route::get('/expiring', [BatchTrackingController::class, 'getExpiringBatches'])->name('expiring');
    Route::get('/{id}', [BatchTrackingController::class, 'show'])->name('show');
    Route::put('/{id}', [BatchTrackingController::class, 'update'])->name('update');
    Route::delete('/{id}', [BatchTrackingController::class, 'destroy'])->name('destroy');
});

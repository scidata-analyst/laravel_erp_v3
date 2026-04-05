<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Ecommerce\InvSyncController;

Route::prefix('pos/inv-sync')->name('pos.inv-sync.')->group(function () {
    Route::get('/', function (Request $request, InvSyncController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.pos.inv-sync');
    })->name('index');
    Route::post('/', [InvSyncController::class, 'store'])->name('store');
    Route::get('/{id}', [InvSyncController::class, 'show'])->name('show');
    Route::put('/{id}', [InvSyncController::class, 'update'])->name('update');
    Route::delete('/{id}', [InvSyncController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/complete', [InvSyncController::class, 'complete'])->name('complete');
});

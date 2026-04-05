<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Ecommerce\OnlineChannelsController;

Route::prefix('pos/online-channels')->name('pos.online-channels.')->group(function () {
    Route::get('/', function (Request $request, OnlineChannelsController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.pos.online-channels');
    })->name('index');
    Route::post('/', [OnlineChannelsController::class, 'store'])->name('store');
    Route::get('/active', [OnlineChannelsController::class, 'active'])->name('active');
    Route::get('/{id}', [OnlineChannelsController::class, 'show'])->name('show');
    Route::put('/{id}', [OnlineChannelsController::class, 'update'])->name('update');
    Route::delete('/{id}', [OnlineChannelsController::class, 'destroy'])->name('destroy');
});

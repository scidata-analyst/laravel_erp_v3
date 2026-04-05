<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Accounting\GlController;

Route::prefix('accounting/gl')->name('accounting.gl.')->group(function () {
    Route::get('/', function (Request $request, GlController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.accounting.gl');
    })->name('index');
    Route::post('/', [GlController::class, 'store'])->name('store');
    Route::get('/balance/{accountName}', [GlController::class, 'getBalance'])->name('balance');
    Route::get('/trial-balance', [GlController::class, 'getTrialBalance'])->name('trial-balance');
    Route::get('/stats', [GlController::class, 'getGlStats'])->name('stats');
    Route::get('/{id}', [GlController::class, 'show'])->name('show');
    Route::put('/{id}', [GlController::class, 'update'])->name('update');
    Route::delete('/{id}', [GlController::class, 'destroy'])->name('destroy');
});

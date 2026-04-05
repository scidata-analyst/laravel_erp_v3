<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Production\BomController;

Route::prefix('production/bom')->name('production.bom.')->group(function () {
    Route::get('/', function (Request $request, BomController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.production.bom');
    })->name('index');
    Route::post('/', [BomController::class, 'store'])->name('store');
    Route::get('/{id}', [BomController::class, 'show'])->name('show');
    Route::put('/{id}', [BomController::class, 'update'])->name('update');
    Route::delete('/{id}', [BomController::class, 'destroy'])->name('destroy');
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Production\MachineLaborController;

Route::prefix('production/machine-labor')->name('production.machine-labor.')->group(function () {
    Route::get('/', function (Request $request, MachineLaborController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.production.machine-labor');
    })->name('index');
    Route::post('/', [MachineLaborController::class, 'store'])->name('store');
    Route::get('/{id}', [MachineLaborController::class, 'show'])->name('show');
    Route::put('/{id}', [MachineLaborController::class, 'update'])->name('update');
    Route::delete('/{id}', [MachineLaborController::class, 'destroy'])->name('destroy');
    Route::get('/cost/{workOrderId}', [MachineLaborController::class, 'getCost'])->name('cost');
});

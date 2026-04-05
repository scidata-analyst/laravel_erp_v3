<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\QualityControl\DefectsController;

Route::prefix('qc/defects')->name('qc.defects.')->group(function () {
    Route::get('/', function (Request $request, DefectsController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.qc.defects');
    })->name('index');
    Route::post('/', [DefectsController::class, 'store'])->name('store');
    Route::get('/{id}', [DefectsController::class, 'show'])->name('show');
    Route::put('/{id}', [DefectsController::class, 'update'])->name('update');
    Route::delete('/{id}', [DefectsController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/resolve', [DefectsController::class, 'resolve'])->name('resolve');
});

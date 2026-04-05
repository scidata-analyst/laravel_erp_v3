<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\QualityControl\QcChecklistsController;

Route::prefix('qc/qc-checklists')->name('qc.qc-checklists.')->group(function () {
    Route::get('/', function (Request $request, QcChecklistsController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.qc.qc-checklists');
    })->name('index');
    Route::post('/', [QcChecklistsController::class, 'store'])->name('store');
    Route::get('/{id}', [QcChecklistsController::class, 'show'])->name('show');
    Route::put('/{id}', [QcChecklistsController::class, 'update'])->name('update');
    Route::delete('/{id}', [QcChecklistsController::class, 'destroy'])->name('destroy');
});

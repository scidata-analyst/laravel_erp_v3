<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\QualityControl\ComplianceController;

Route::prefix('qc/compliance')->name('qc.compliance.')->group(function () {
    Route::get('/', function (Request $request, ComplianceController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.qc.compliance');
    })->name('index');
    Route::post('/', [ComplianceController::class, 'store'])->name('store');
    Route::get('/active', [ComplianceController::class, 'active'])->name('active');
    Route::get('/{id}', [ComplianceController::class, 'show'])->name('show');
    Route::put('/{id}', [ComplianceController::class, 'update'])->name('update');
    Route::delete('/{id}', [ComplianceController::class, 'destroy'])->name('destroy');
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HR\PayrollController;

Route::prefix('hr/payroll')->name('hr.payroll.')->group(function () {
    Route::get('/', function (Request $request, PayrollController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.hr.payroll');
    })->name('index');
    Route::post('/', [PayrollController::class, 'store'])->name('store');
    Route::post('/generate', [PayrollController::class, 'generate'])->name('generate');
    Route::get('/{id}', [PayrollController::class, 'show'])->name('show');
    Route::put('/{id}', [PayrollController::class, 'update'])->name('update');
    Route::delete('/{id}', [PayrollController::class, 'destroy'])->name('destroy');
});

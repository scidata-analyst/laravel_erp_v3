<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HR\EmployeesController;

Route::prefix('hr/employees')->name('hr.employees.')->group(function () {
    Route::get('/', function (Request $request, EmployeesController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.hr.employees');
    })->name('index');
    Route::post('/', [EmployeesController::class, 'store'])->name('store');
    Route::get('/{id}', [EmployeesController::class, 'show'])->name('show');
    Route::put('/{id}', [EmployeesController::class, 'update'])->name('update');
    Route::delete('/{id}', [EmployeesController::class, 'destroy'])->name('destroy');
});

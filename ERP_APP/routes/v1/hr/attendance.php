<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HR\AttendanceController;

Route::prefix('hr/attendance')->name('hr.attendance.')->group(function () {
    Route::get('/', function (Request $request, AttendanceController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.hr.attendance');
    })->name('index');
    Route::post('/', [AttendanceController::class, 'store'])->name('store');
    Route::post('/check-in', [AttendanceController::class, 'checkIn'])->name('check-in');
    Route::post('/check-out', [AttendanceController::class, 'checkOut'])->name('check-out');
    Route::get('/{id}', [AttendanceController::class, 'show'])->name('show');
    Route::put('/{id}', [AttendanceController::class, 'update'])->name('update');
    Route::delete('/{id}', [AttendanceController::class, 'destroy'])->name('destroy');
});

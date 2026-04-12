<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HR\AttendanceController;

/**
 * =============================================================================
 * MODULE  : HR
 * ENTITY  : Attendance
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/HR/attendance
 *
 * Structure:
 *   GET    /all    Fetch all records
 *   GET    /       Paginated list
 *   POST   /       Create record
 *   GET    /{id}   Show record
 *   PUT    /{id}   Update record
 *   DELETE /{id}   Delete record
 * =============================================================================
 */

Route::prefix('api/v1/hr/attendance')->group(function () {

    
    Route::get('/all', [AttendanceController::class, 'all'])
        ->name('attendance.all');

    
    Route::get('/', [AttendanceController::class, 'index'])
        ->name('attendance.index');

    
    Route::post('/', [AttendanceController::class, 'store'])
        ->name('attendance.store');

    
    Route::get('/{id}', [AttendanceController::class, 'show'])
        ->name('attendance.show');

    
    Route::put('/{id}', [AttendanceController::class, 'update'])
        ->name('attendance.update');

    
    Route::delete('/{id}', [AttendanceController::class, 'destroy'])
        ->name('attendance.destroy');

});

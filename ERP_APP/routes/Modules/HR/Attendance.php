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

Route::prefix('api/v1/HR/attendance')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [AttendanceController::class, 'all'])
        ->name('attendance.all');

    // Paginated list
    Route::get('/', [AttendanceController::class, 'index'])
        ->name('attendance.index');

    // Create
    Route::post('/', [AttendanceController::class, 'store'])
        ->name('attendance.store');

    // Show single
    Route::get('/{id}', [AttendanceController::class, 'show'])
        ->name('attendance.show');

    // Update
    Route::put('/{id}', [AttendanceController::class, 'update'])
        ->name('attendance.update');

    // Delete
    Route::delete('/{id}', [AttendanceController::class, 'destroy'])
        ->name('attendance.destroy');

});

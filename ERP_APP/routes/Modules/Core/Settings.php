<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Core\SettingsController;

/**
 * =============================================================================
 * MODULE  : Core
 * ENTITY  : Settings
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Core/settings
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

Route::prefix('api/v1/Core/settings')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [SettingsController::class, 'all'])
        ->name('settings.all');

    // Paginated list
    Route::get('/', [SettingsController::class, 'index'])
        ->name('settings.index');

    // Create
    Route::post('/', [SettingsController::class, 'store'])
        ->name('settings.store');

    // Show single
    Route::get('/{id}', [SettingsController::class, 'show'])
        ->name('settings.show');

    // Update
    Route::put('/{id}', [SettingsController::class, 'update'])
        ->name('settings.update');

    // Delete
    Route::delete('/{id}', [SettingsController::class, 'destroy'])
        ->name('settings.destroy');

});

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

Route::prefix('api/v1/core/settings')->group(function () {

    
    Route::get('/all', [SettingsController::class, 'all'])
        ->name('settings.all');

    
    Route::get('/', [SettingsController::class, 'index'])
        ->name('settings.index');

    
    Route::post('/', [SettingsController::class, 'store'])
        ->name('settings.store');

    
    Route::get('/{id}', [SettingsController::class, 'show'])
        ->name('settings.show');

    
    Route::put('/{id}', [SettingsController::class, 'update'])
        ->name('settings.update');

    
    Route::delete('/{id}', [SettingsController::class, 'destroy'])
        ->name('settings.destroy');

});

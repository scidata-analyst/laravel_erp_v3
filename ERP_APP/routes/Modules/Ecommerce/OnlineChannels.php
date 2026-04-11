<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ecommerce\OnlineChannelsController;

/**
 * =============================================================================
 * MODULE  : Ecommerce
 * ENTITY  : OnlineChannels
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Ecommerce/online-channels
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

Route::prefix('api/v1/Ecommerce/online-channels')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [OnlineChannelsController::class, 'all'])
        ->name('online_channels.all');

    // Paginated list
    Route::get('/', [OnlineChannelsController::class, 'index'])
        ->name('online_channels.index');

    // Create
    Route::post('/', [OnlineChannelsController::class, 'store'])
        ->name('online_channels.store');

    // Show single
    Route::get('/{id}', [OnlineChannelsController::class, 'show'])
        ->name('online_channels.show');

    // Update
    Route::put('/{id}', [OnlineChannelsController::class, 'update'])
        ->name('online_channels.update');

    // Delete
    Route::delete('/{id}', [OnlineChannelsController::class, 'destroy'])
        ->name('online_channels.destroy');

});

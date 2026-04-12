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

Route::prefix('api/v1/ecommerce/online-channels')->group(function () {

    
    Route::get('/all', [OnlineChannelsController::class, 'all'])
        ->name('online_channels.all');

    
    Route::get('/', [OnlineChannelsController::class, 'index'])
        ->name('online_channels.index');

    
    Route::post('/', [OnlineChannelsController::class, 'store'])
        ->name('online_channels.store');

    
    Route::get('/{id}', [OnlineChannelsController::class, 'show'])
        ->name('online_channels.show');

    
    Route::put('/{id}', [OnlineChannelsController::class, 'update'])
        ->name('online_channels.update');

    
    Route::delete('/{id}', [OnlineChannelsController::class, 'destroy'])
        ->name('online_channels.destroy');

});

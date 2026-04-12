<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRM\InteractionsController;

/**
 * =============================================================================
 * MODULE  : CRM
 * ENTITY  : Interactions
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/CRM/interactions
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

Route::prefix('api/v1/crm/interactions')->group(function () {

    
    Route::get('/all', [InteractionsController::class, 'all'])
        ->name('interactions.all');

    
    Route::get('/', [InteractionsController::class, 'index'])
        ->name('interactions.index');

    
    Route::post('/', [InteractionsController::class, 'store'])
        ->name('interactions.store');

    
    Route::get('/{id}', [InteractionsController::class, 'show'])
        ->name('interactions.show');

    
    Route::put('/{id}', [InteractionsController::class, 'update'])
        ->name('interactions.update');

    
    Route::delete('/{id}', [InteractionsController::class, 'destroy'])
        ->name('interactions.destroy');

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sales\PromotionsController;

/**
 * =============================================================================
 * MODULE  : Sales
 * ENTITY  : Promotions
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Sales/promotions
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

Route::prefix('api/v1/sales/promotions')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [PromotionsController::class, 'all'])
        ->name('promotions.all');

    // Paginated list
    Route::get('/', [PromotionsController::class, 'index'])
        ->name('promotions.index');

    // Create
    Route::post('/', [PromotionsController::class, 'store'])
        ->name('promotions.store');

    // Show single
    Route::get('/{id}', [PromotionsController::class, 'show'])
        ->name('promotions.show');

    // Update
    Route::put('/{id}', [PromotionsController::class, 'update'])
        ->name('promotions.update');

    // Delete
    Route::delete('/{id}', [PromotionsController::class, 'destroy'])
        ->name('promotions.destroy');

});

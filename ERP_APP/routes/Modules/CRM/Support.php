<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRM\SupportController;

/**
 * =============================================================================
 * MODULE  : CRM
 * ENTITY  : Support
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/CRM/support
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

Route::prefix('api/v1/crm/support')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [SupportController::class, 'all'])
        ->name('support.all');

    // Paginated list
    Route::get('/', [SupportController::class, 'index'])
        ->name('support.index');

    // Create
    Route::post('/', [SupportController::class, 'store'])
        ->name('support.store');

    // Show single
    Route::get('/{id}', [SupportController::class, 'show'])
        ->name('support.show');

    // Update
    Route::put('/{id}', [SupportController::class, 'update'])
        ->name('support.update');

    // Delete
    Route::delete('/{id}', [SupportController::class, 'destroy'])
        ->name('support.destroy');

});

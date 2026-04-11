<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRM\LeadsController;

/**
 * =============================================================================
 * MODULE  : CRM
 * ENTITY  : Leads
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/CRM/leads
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

Route::prefix('api/v1/CRM/leads')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [LeadsController::class, 'all'])
        ->name('leads.all');

    // Paginated list
    Route::get('/', [LeadsController::class, 'index'])
        ->name('leads.index');

    // Create
    Route::post('/', [LeadsController::class, 'store'])
        ->name('leads.store');

    // Show single
    Route::get('/{id}', [LeadsController::class, 'show'])
        ->name('leads.show');

    // Update
    Route::put('/{id}', [LeadsController::class, 'update'])
        ->name('leads.update');

    // Delete
    Route::delete('/{id}', [LeadsController::class, 'destroy'])
        ->name('leads.destroy');

});

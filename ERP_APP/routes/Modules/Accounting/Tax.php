<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accounting\TaxController;

/**
 * =============================================================================
 * MODULE  : Accounting
 * ENTITY  : Tax
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Accounting/tax
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

Route::prefix('api/v1/Accounting/tax')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [TaxController::class, 'all'])
        ->name('tax.all');

    // Paginated list
    Route::get('/', [TaxController::class, 'index'])
        ->name('tax.index');

    // Create
    Route::post('/', [TaxController::class, 'store'])
        ->name('tax.store');

    // Show single
    Route::get('/{id}', [TaxController::class, 'show'])
        ->name('tax.show');

    // Update
    Route::put('/{id}', [TaxController::class, 'update'])
        ->name('tax.update');

    // Delete
    Route::delete('/{id}', [TaxController::class, 'destroy'])
        ->name('tax.destroy');

});

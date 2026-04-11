<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sales\InvoicesController;

/**
 * =============================================================================
 * MODULE  : Sales
 * ENTITY  : Invoices
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Sales/invoices
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

Route::prefix('api/v1/Sales/invoices')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [InvoicesController::class, 'all'])
        ->name('invoices.all');

    // Paginated list
    Route::get('/', [InvoicesController::class, 'index'])
        ->name('invoices.index');

    // Create
    Route::post('/', [InvoicesController::class, 'store'])
        ->name('invoices.store');

    // Show single
    Route::get('/{id}', [InvoicesController::class, 'show'])
        ->name('invoices.show');

    // Update
    Route::put('/{id}', [InvoicesController::class, 'update'])
        ->name('invoices.update');

    // Delete
    Route::delete('/{id}', [InvoicesController::class, 'destroy'])
        ->name('invoices.destroy');

});

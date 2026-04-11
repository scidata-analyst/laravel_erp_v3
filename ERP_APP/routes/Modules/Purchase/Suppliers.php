<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Purchase\SuppliersController;

/**
 * =============================================================================
 * MODULE  : Purchase
 * ENTITY  : Suppliers
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Purchase/suppliers
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

Route::prefix('api/v1/purchase/suppliers')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [SuppliersController::class, 'all'])
        ->name('suppliers.all');

    // Paginated list
    Route::get('/', [SuppliersController::class, 'index'])
        ->name('suppliers.index');

    // Create
    Route::post('/', [SuppliersController::class, 'store'])
        ->name('suppliers.store');

    // Show single
    Route::get('/{id}', [SuppliersController::class, 'show'])
        ->name('suppliers.show');

    // Update
    Route::put('/{id}', [SuppliersController::class, 'update'])
        ->name('suppliers.update');

    // Delete
    Route::delete('/{id}', [SuppliersController::class, 'destroy'])
        ->name('suppliers.destroy');

});

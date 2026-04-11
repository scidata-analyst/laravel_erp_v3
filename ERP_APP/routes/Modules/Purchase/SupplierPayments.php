<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Purchase\SupplierPaymentsController;

/**
 * =============================================================================
 * MODULE  : Purchase
 * ENTITY  : SupplierPayments
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Purchase/supplier-payments
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

Route::prefix('api/v1/Purchase/supplier-payments')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [SupplierPaymentsController::class, 'all'])
        ->name('supplier_payments.all');

    // Paginated list
    Route::get('/', [SupplierPaymentsController::class, 'index'])
        ->name('supplier_payments.index');

    // Create
    Route::post('/', [SupplierPaymentsController::class, 'store'])
        ->name('supplier_payments.store');

    // Show single
    Route::get('/{id}', [SupplierPaymentsController::class, 'show'])
        ->name('supplier_payments.show');

    // Update
    Route::put('/{id}', [SupplierPaymentsController::class, 'update'])
        ->name('supplier_payments.update');

    // Delete
    Route::delete('/{id}', [SupplierPaymentsController::class, 'destroy'])
        ->name('supplier_payments.destroy');

});

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

    
    Route::get('/all', [SuppliersController::class, 'all'])
        ->name('suppliers.all');

    
    Route::get('/', [SuppliersController::class, 'index'])
        ->name('suppliers.index');

    
    Route::post('/', [SuppliersController::class, 'store'])
        ->name('suppliers.store');

    
    Route::get('/{id}', [SuppliersController::class, 'show'])
        ->name('suppliers.show');

    
    Route::put('/{id}', [SuppliersController::class, 'update'])
        ->name('suppliers.update');

    
    Route::delete('/{id}', [SuppliersController::class, 'destroy'])
        ->name('suppliers.destroy');

});

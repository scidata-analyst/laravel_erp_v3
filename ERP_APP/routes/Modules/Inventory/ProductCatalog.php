<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inventory\ProductCatalogController;

/**
 * =============================================================================
 * MODULE  : Inventory
 * ENTITY  : ProductCatalog
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Inventory/product-catalog
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

Route::prefix('api/v1/Inventory/product-catalog')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [ProductCatalogController::class, 'all'])
        ->name('product_catalog.all');

    // Paginated list
    Route::get('/', [ProductCatalogController::class, 'index'])
        ->name('product_catalog.index');

    // Create
    Route::post('/', [ProductCatalogController::class, 'store'])
        ->name('product_catalog.store');

    // Show single
    Route::get('/{id}', [ProductCatalogController::class, 'show'])
        ->name('product_catalog.show');

    // Update
    Route::put('/{id}', [ProductCatalogController::class, 'update'])
        ->name('product_catalog.update');

    // Delete
    Route::delete('/{id}', [ProductCatalogController::class, 'destroy'])
        ->name('product_catalog.destroy');

});

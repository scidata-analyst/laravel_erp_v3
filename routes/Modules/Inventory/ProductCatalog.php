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

Route::prefix('api/v1/inventory/product-catalog')->group(function () {

    
    Route::get('/all', [ProductCatalogController::class, 'all'])
        ->name('product_catalog.all');

    
    Route::get('/', [ProductCatalogController::class, 'index'])
        ->name('product_catalog.index');

    
    Route::post('/', [ProductCatalogController::class, 'store'])
        ->name('product_catalog.store');

    
    Route::get('/{id}', [ProductCatalogController::class, 'show'])
        ->name('product_catalog.show');

    
    Route::put('/{id}', [ProductCatalogController::class, 'update'])
        ->name('product_catalog.update');

    
    Route::delete('/{id}', [ProductCatalogController::class, 'destroy'])
        ->name('product_catalog.destroy');

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Documents\DocVersionsController;

/**
 * =============================================================================
 * MODULE  : Documents
 * ENTITY  : DocVersions
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Documents/doc-versions
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

Route::prefix('api/v1/documents/doc-versions')->group(function () {

    
    Route::get('/all', [DocVersionsController::class, 'all'])
        ->name('doc_versions.all');

    
    Route::get('/', [DocVersionsController::class, 'index'])
        ->name('doc_versions.index');

    
    Route::post('/', [DocVersionsController::class, 'store'])
        ->name('doc_versions.store');

    
    Route::get('/{id}', [DocVersionsController::class, 'show'])
        ->name('doc_versions.show');

    
    Route::put('/{id}', [DocVersionsController::class, 'update'])
        ->name('doc_versions.update');

    
    Route::delete('/{id}', [DocVersionsController::class, 'destroy'])
        ->name('doc_versions.destroy');

});

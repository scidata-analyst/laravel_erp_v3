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

    // Get all records (no pagination)
    Route::get('/all', [DocVersionsController::class, 'all'])
        ->name('doc_versions.all');

    // Paginated list
    Route::get('/', [DocVersionsController::class, 'index'])
        ->name('doc_versions.index');

    // Create
    Route::post('/', [DocVersionsController::class, 'store'])
        ->name('doc_versions.store');

    // Show single
    Route::get('/{id}', [DocVersionsController::class, 'show'])
        ->name('doc_versions.show');

    // Update
    Route::put('/{id}', [DocVersionsController::class, 'update'])
        ->name('doc_versions.update');

    // Delete
    Route::delete('/{id}', [DocVersionsController::class, 'destroy'])
        ->name('doc_versions.destroy');

});

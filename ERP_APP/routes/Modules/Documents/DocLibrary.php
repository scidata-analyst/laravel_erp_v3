<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Documents\DocLibraryController;

/**
 * =============================================================================
 * MODULE  : Documents
 * ENTITY  : DocLibrary
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Documents/doc-library
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

Route::prefix('api/v1/Documents/doc-library')->group(function () {

    // Get all records (no pagination)
    Route::get('/all', [DocLibraryController::class, 'all'])
        ->name('doc_library.all');

    // Paginated list
    Route::get('/', [DocLibraryController::class, 'index'])
        ->name('doc_library.index');

    // Create
    Route::post('/', [DocLibraryController::class, 'store'])
        ->name('doc_library.store');

    // Show single
    Route::get('/{id}', [DocLibraryController::class, 'show'])
        ->name('doc_library.show');

    // Update
    Route::put('/{id}', [DocLibraryController::class, 'update'])
        ->name('doc_library.update');

    // Delete
    Route::delete('/{id}', [DocLibraryController::class, 'destroy'])
        ->name('doc_library.destroy');

});

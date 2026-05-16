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

Route::prefix('api/v1/documents/doc-library')->group(function () {

    
    Route::get('/all', [DocLibraryController::class, 'all'])
        ->name('doc_library.all');

    
    Route::get('/', [DocLibraryController::class, 'index'])
        ->name('doc_library.index');

    
    Route::post('/', [DocLibraryController::class, 'store'])
        ->name('doc_library.store');

    
    Route::get('/{id}', [DocLibraryController::class, 'show'])
        ->name('doc_library.show');

    
    Route::put('/{id}', [DocLibraryController::class, 'update'])
        ->name('doc_library.update');

    
    Route::delete('/{id}', [DocLibraryController::class, 'destroy'])
        ->name('doc_library.destroy');

});

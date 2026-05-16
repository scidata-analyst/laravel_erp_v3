<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accounting\ApArController;

/**
 * =============================================================================
 * MODULE  : Accounting
 * ENTITY  : ApAr
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/Accounting/ap-ar
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

Route::prefix('api/v1/accounting/ap-ar')->group(function () {

    
    Route::get('/all', [ApArController::class, 'all'])
        ->name('ap_ar.all');

    
    Route::get('/', [ApArController::class, 'index'])
        ->name('ap_ar.index');

    
    Route::post('/', [ApArController::class, 'store'])
        ->name('ap_ar.store');

    
    Route::get('/{id}', [ApArController::class, 'show'])
        ->name('ap_ar.show');

    
    Route::put('/{id}', [ApArController::class, 'update'])
        ->name('ap_ar.update');

    
    Route::delete('/{id}', [ApArController::class, 'destroy'])
        ->name('ap_ar.destroy');

});

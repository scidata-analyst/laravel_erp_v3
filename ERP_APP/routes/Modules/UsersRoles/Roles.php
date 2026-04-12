<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersRoles\RolesController;

/**
 * =============================================================================
 * MODULE  : UsersRoles
 * ENTITY  : Roles
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/UsersRoles/roles
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

Route::prefix('api/v1/usersroles/roles')->group(function () {

    
    Route::get('/all', [RolesController::class, 'all'])
        ->name('roles.all');

    
    Route::get('/', [RolesController::class, 'index'])
        ->name('roles.index');

    
    Route::post('/', [RolesController::class, 'store'])
        ->name('roles.store');

    
    Route::get('/{id}', [RolesController::class, 'show'])
        ->name('roles.show');

    
    Route::put('/{id}', [RolesController::class, 'update'])
        ->name('roles.update');

    
    Route::delete('/{id}', [RolesController::class, 'destroy'])
        ->name('roles.destroy');

});

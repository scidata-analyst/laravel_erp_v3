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

    // Get all records (no pagination)
    Route::get('/all', [RolesController::class, 'all'])
        ->name('roles.all');

    // Paginated list
    Route::get('/', [RolesController::class, 'index'])
        ->name('roles.index');

    // Create
    Route::post('/', [RolesController::class, 'store'])
        ->name('roles.store');

    // Show single
    Route::get('/{id}', [RolesController::class, 'show'])
        ->name('roles.show');

    // Update
    Route::put('/{id}', [RolesController::class, 'update'])
        ->name('roles.update');

    // Delete
    Route::delete('/{id}', [RolesController::class, 'destroy'])
        ->name('roles.destroy');

});

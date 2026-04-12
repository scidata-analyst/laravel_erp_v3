<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersRoles\UserController;

/**
 * =============================================================================
 * MODULE  : UsersRoles
 * ENTITY  : User
 * =============================================================================
 * Auto-generated route file (ENTITY level)
 *
 * Base API:
 *   api/v1/UsersRoles/user
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

Route::prefix('api/v1/usersroles/user')->group(function () {

    
    Route::get('/all', [UserController::class, 'all'])
        ->name('user.all');

    
    Route::get('/', [UserController::class, 'index'])
        ->name('user.index');

    
    Route::post('/', [UserController::class, 'store'])
        ->name('user.store');

    
    Route::get('/{id}', [UserController::class, 'show'])
        ->name('user.show');

    
    Route::put('/{id}', [UserController::class, 'update'])
        ->name('user.update');

    
    Route::delete('/{id}', [UserController::class, 'destroy'])
        ->name('user.destroy');

});

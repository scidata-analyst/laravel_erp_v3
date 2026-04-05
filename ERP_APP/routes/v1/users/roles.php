<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UsersRoles\RolesController;

Route::prefix('users/roles')->name('users.roles.')->group(function () {
    Route::get('/', function (Request $request, RolesController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.users.roles');
    })->name('index');
    Route::post('/', [RolesController::class, 'store'])->name('store');
    Route::get('/{id}', [RolesController::class, 'show'])->name('show');
    Route::put('/{id}', [RolesController::class, 'update'])->name('update');
    Route::delete('/{id}', [RolesController::class, 'destroy'])->name('destroy');
});

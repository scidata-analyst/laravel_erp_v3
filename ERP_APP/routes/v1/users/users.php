<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UsersRoles\UsersController;

Route::prefix('users/users')->name('users.users.')->group(function () {
    Route::get('/', function (Request $request, UsersController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.users.users');
    })->name('index');
    Route::post('/', [UsersController::class, 'store'])->name('store');
    Route::get('/{id}', [UsersController::class, 'show'])->name('show');
    Route::put('/{id}', [UsersController::class, 'update'])->name('update');
    Route::delete('/{id}', [UsersController::class, 'destroy'])->name('destroy');
});

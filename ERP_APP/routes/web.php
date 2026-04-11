<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (Core Application)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard Route
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Laravel Breeze / Jetstream)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| ERP MODULE ROUTES (AUTO GENERATED)
|--------------------------------------------------------------------------
| All ERP module routes are generated under:
|   routes/Modules/*
|
| Each module file is automatically loaded here.
| Example:
|   routes/Modules/Accounting/ApAr.php
|   routes/Modules/CRM/Support.php
|--------------------------------------------------------------------------
*/

foreach (glob(base_path('routes/Modules/*/*.php')) as $routeFile) {
    require $routeFile;
}
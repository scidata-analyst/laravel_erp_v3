<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Core\DashboardController;

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', function () { return view('pages.index'); })->name('index');
    Route::post('/', [DashboardController::class, 'store'])->name('store');
    Route::get('/stats', [DashboardController::class, 'stats'])->name('stats');
});

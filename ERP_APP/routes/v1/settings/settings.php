<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Core\SettingsController;

Route::prefix('settings/settings')->name('settings.settings.')->group(function () {
    Route::get('/', function (Request $request, SettingsController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.settings.settings');
    })->name('index');
    Route::post('/', [SettingsController::class, 'store'])->name('store');
    Route::get('/{key}', [SettingsController::class, 'show'])->name('show');
    Route::delete('/{id}', [SettingsController::class, 'destroy'])->name('destroy');
});

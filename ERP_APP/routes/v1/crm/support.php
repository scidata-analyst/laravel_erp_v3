<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CRM\SupportController;

Route::prefix('crm/support')->name('crm.support.')->group(function () {
    Route::get('/', function (Request $request, SupportController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.crm.support');
    })->name('index');
    Route::post('/', [SupportController::class, 'store'])->name('store');
    Route::get('/{id}', [SupportController::class, 'show'])->name('show');
    Route::put('/{id}', [SupportController::class, 'update'])->name('update');
    Route::delete('/{id}', [SupportController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/resolve', [SupportController::class, 'resolve'])->name('resolve');
});

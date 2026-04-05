<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CRM\InteractionsController;

Route::prefix('crm/interactions')->name('crm.interactions.')->group(function () {
    Route::get('/', function (Request $request, InteractionsController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.crm.interactions');
    })->name('index');
    Route::post('/', [InteractionsController::class, 'store'])->name('store');
    Route::get('/by-subject', [InteractionsController::class, 'getBySubject'])->name('by-subject');
    Route::get('/{id}', [InteractionsController::class, 'show'])->name('show');
    Route::put('/{id}', [InteractionsController::class, 'update'])->name('update');
    Route::delete('/{id}', [InteractionsController::class, 'destroy'])->name('destroy');
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CRM\LeadsController;

Route::prefix('crm/leads')->name('crm.leads.')->group(function () {
    Route::get('/', function (Request $request, LeadsController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.crm.leads');
    })->name('index');
    Route::post('/', [LeadsController::class, 'store'])->name('store');
    Route::get('/{id}', [LeadsController::class, 'show'])->name('show');
    Route::put('/{id}', [LeadsController::class, 'update'])->name('update');
    Route::delete('/{id}', [LeadsController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/convert', [LeadsController::class, 'convert'])->name('convert');
});

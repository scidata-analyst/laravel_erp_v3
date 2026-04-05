<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Projects\ResourcesController;

Route::prefix('project/resources')->name('project.resources.')->group(function () {
    Route::get('/', function (Request $request, ResourcesController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.project.resources');
    })->name('index');
    Route::post('/', [ResourcesController::class, 'store'])->name('store');
    Route::get('/{id}', [ResourcesController::class, 'show'])->name('show');
    Route::put('/{id}', [ResourcesController::class, 'update'])->name('update');
    Route::delete('/{id}', [ResourcesController::class, 'destroy'])->name('destroy');
    Route::put('/{id}/allocation', [ResourcesController::class, 'updateAllocation'])->name('update-allocation');
});

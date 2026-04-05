<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Projects\ProjectCostController;

Route::prefix('project/project-cost')->name('project.project-cost.')->group(function () {
    Route::get('/', function (Request $request, ProjectCostController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.project.project-cost');
    })->name('index');
    Route::post('/', [ProjectCostController::class, 'store'])->name('store');
    Route::get('/{id}', [ProjectCostController::class, 'show'])->name('show');
    Route::put('/{id}', [ProjectCostController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProjectCostController::class, 'destroy'])->name('destroy');
    Route::get('/summary/{projectId}', [ProjectCostController::class, 'summary'])->name('summary');
    Route::post('/{id}/approve', [ProjectCostController::class, 'approve'])->name('approve');
});

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Projects\TasksController;

Route::prefix('project/tasks')->name('project.tasks.')->group(function () {
    Route::get('/', function (Request $request, TasksController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.project.tasks');
    })->name('index');
    Route::post('/', [TasksController::class, 'store'])->name('store');
    Route::get('/{id}', [TasksController::class, 'show'])->name('show');
    Route::put('/{id}', [TasksController::class, 'update'])->name('update');
    Route::delete('/{id}', [TasksController::class, 'destroy'])->name('destroy');
    Route::put('/{id}/progress', [TasksController::class, 'updateProgress'])->name('update-progress');
});

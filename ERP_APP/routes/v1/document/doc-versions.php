<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Documents\DocVersionsController;

Route::prefix('document/doc-versions')->name('document.doc-versions.')->group(function () {
    Route::get('/', function (Request $request, DocVersionsController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.document.doc-versions');
    })->name('index');
    Route::post('/', [DocVersionsController::class, 'store'])->name('store');
    Route::get('/history/{documentId}', [DocVersionsController::class, 'history'])->name('history');
    Route::get('/{id}', [DocVersionsController::class, 'show'])->name('show');
    Route::put('/{id}', [DocVersionsController::class, 'update'])->name('update');
    Route::delete('/{id}', [DocVersionsController::class, 'destroy'])->name('destroy');
});

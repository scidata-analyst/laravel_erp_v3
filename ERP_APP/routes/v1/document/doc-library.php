<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Documents\DocLibraryController;

Route::prefix('document/doc-library')->name('document.doc-library.')->group(function () {
    Route::get('/', function (Request $request, DocLibraryController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.document.doc-library');
    })->name('index');
    Route::post('/', [DocLibraryController::class, 'store'])->name('store');
    Route::get('/{id}', [DocLibraryController::class, 'show'])->name('show');
    Route::put('/{id}', [DocLibraryController::class, 'update'])->name('update');
    Route::delete('/{id}', [DocLibraryController::class, 'destroy'])->name('destroy');
});

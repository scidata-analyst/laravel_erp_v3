<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Sales\InvoicesController;

Route::prefix('sales/invoices')->name('sales.invoices.')->group(function () {
    Route::get('/', function (Request $request, InvoicesController $controller) {
        if ($request->expectsJson() || $request->ajax()) {
            return app()->call([$controller, 'index']);
        }

        return view('pages.sales.invoices');
    })->name('index');
    Route::post('/', [InvoicesController::class, 'store'])->name('store');
    Route::get('/overdue', [InvoicesController::class, 'getOverdue'])->name('overdue');
    Route::get('/{id}', [InvoicesController::class, 'show'])->name('show');
    Route::post('/{id}/mark-paid', [InvoicesController::class, 'markPaid'])->name('mark-paid');
});

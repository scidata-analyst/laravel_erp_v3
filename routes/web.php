<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (Core Application)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard Route
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Laravel Breeze / Jetstream)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| ERP MODULE ROUTES
|--------------------------------------------------------------------------
|
| Each module route file is included individually below.
|--------------------------------------------------------------------------
*/

require __DIR__.'/Modules/Accounting/ApAr.php';
require __DIR__.'/Modules/Accounting/FinReports.php';
require __DIR__.'/Modules/Accounting/Gl.php';
require __DIR__.'/Modules/Accounting/Tax.php';
require __DIR__.'/Modules/Core/Dashboard.php';
require __DIR__.'/Modules/Core/Settings.php';
require __DIR__.'/Modules/CRM/Interactions.php';
require __DIR__.'/Modules/CRM/Leads.php';
require __DIR__.'/Modules/CRM/Support.php';
require __DIR__.'/Modules/Documents/DocLibrary.php';
require __DIR__.'/Modules/Documents/DocVersions.php';
require __DIR__.'/Modules/Ecommerce/InvSync.php';
require __DIR__.'/Modules/Ecommerce/OnlineChannels.php';
require __DIR__.'/Modules/Ecommerce/Pos.php';
require __DIR__.'/Modules/HR/Attendance.php';
require __DIR__.'/Modules/HR/Employees.php';
require __DIR__.'/Modules/HR/Payroll.php';
require __DIR__.'/Modules/HR/Performance.php';
require __DIR__.'/Modules/Inventory/BatchTracking.php';
require __DIR__.'/Modules/Inventory/ProductCatalog.php';
require __DIR__.'/Modules/Inventory/StockMovements.php';
require __DIR__.'/Modules/Inventory/StockValuation.php';
require __DIR__.'/Modules/Logistics/Routes.php';
require __DIR__.'/Modules/Logistics/Shipments.php';
require __DIR__.'/Modules/Logistics/Warehouses.php';
require __DIR__.'/Modules/Production/Bom.php';
require __DIR__.'/Modules/Production/MachineLabor.php';
require __DIR__.'/Modules/Production/WorkOrders.php';
require __DIR__.'/Modules/Projects/ProjectCost.php';
require __DIR__.'/Modules/Projects/Resources.php';
require __DIR__.'/Modules/Projects/Tasks.php';
require __DIR__.'/Modules/Purchase/Grn.php';
require __DIR__.'/Modules/Purchase/PurchaseOrders.php';
require __DIR__.'/Modules/Purchase/SupplierPayments.php';
require __DIR__.'/Modules/Purchase/Suppliers.php';
require __DIR__.'/Modules/QualityControl/Compliance.php';
require __DIR__.'/Modules/QualityControl/Defects.php';
require __DIR__.'/Modules/QualityControl/QcChecklists.php';
require __DIR__.'/Modules/Reports/BiDashboards.php';
require __DIR__.'/Modules/Reports/CustomReports.php';
require __DIR__.'/Modules/Reports/Forecasting.php';
require __DIR__.'/Modules/Sales/Customers.php';
require __DIR__.'/Modules/Sales/Invoices.php';
require __DIR__.'/Modules/Sales/Promotions.php';
require __DIR__.'/Modules/Sales/SalesOrders.php';
require __DIR__.'/Modules/UsersRoles/Roles.php';
require __DIR__.'/Modules/UsersRoles/User.php';
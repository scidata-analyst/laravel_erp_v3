<?php

use App\Http\Controllers\Accounting\ApArController;
use App\Http\Controllers\Accounting\FinReportsController;
use App\Http\Controllers\Accounting\GlController;
use App\Http\Controllers\Accounting\TaxController;
use App\Http\Controllers\Core\DashboardController;
use App\Http\Controllers\Core\SettingsController;
use App\Http\Controllers\CRM\InteractionsController;
use App\Http\Controllers\CRM\LeadsController;
use App\Http\Controllers\CRM\SupportController;
use App\Http\Controllers\Documents\DocLibraryController;
use App\Http\Controllers\Documents\DocVersionsController;
use App\Http\Controllers\Ecommerce\InvSyncController;
use App\Http\Controllers\Ecommerce\OnlineChannelsController;
use App\Http\Controllers\Ecommerce\PosController;
use App\Http\Controllers\HR\AttendanceController;
use App\Http\Controllers\HR\EmployeesController;
use App\Http\Controllers\HR\PayrollController;
use App\Http\Controllers\HR\PerformanceController;
use App\Http\Controllers\Inventory\BatchTrackingController;
use App\Http\Controllers\Inventory\ProductCatalogController;
use App\Http\Controllers\Inventory\StockMovementsController;
use App\Http\Controllers\Inventory\StockValuationController;
use App\Http\Controllers\Logistics\RoutesController;
use App\Http\Controllers\Logistics\ShipmentsController;
use App\Http\Controllers\Logistics\WarehousesController;
use App\Http\Controllers\Production\BomController;
use App\Http\Controllers\Production\MachineLaborController;
use App\Http\Controllers\Production\WorkOrdersController;
use App\Http\Controllers\Projects\ProjectCostController;
use App\Http\Controllers\Projects\ResourcesController;
use App\Http\Controllers\Projects\TasksController;
use App\Http\Controllers\Purchase\GrnController;
use App\Http\Controllers\Purchase\PurchaseOrdersController;
use App\Http\Controllers\Purchase\SupplierPaymentsController;
use App\Http\Controllers\Purchase\SuppliersController;
use App\Http\Controllers\QualityControl\ComplianceController;
use App\Http\Controllers\QualityControl\DefectsController;
use App\Http\Controllers\QualityControl\QcChecklistsController;
use App\Http\Controllers\Reports\BiDashboardsController;
use App\Http\Controllers\Reports\CustomReportsController;
use App\Http\Controllers\Reports\ForecastingController;
use App\Http\Controllers\Sales\CustomersController;
use App\Http\Controllers\Sales\InvoicesController;
use App\Http\Controllers\Sales\PromotionsController;
use App\Http\Controllers\Sales\SalesOrdersController;
use App\Http\Controllers\UsersRoles\RolesController;
use App\Http\Controllers\UsersRoles\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('user');
    Route::get('/roles', [RolesController::class, 'index'])->name('roles');

    Route::get('/products', [ProductCatalogController::class, 'index'])->name('product_catalog');
    Route::get('/stock-movements', [StockMovementsController::class, 'index'])->name('stock_movements');
    Route::get('/batch-tracking', [BatchTrackingController::class, 'index'])->name('batch_tracking');
    Route::get('/stock-valuation', [StockValuationController::class, 'index'])->name('stock_valuation');

    Route::get('/suppliers', [SuppliersController::class, 'index'])->name('suppliers');
    Route::get('/purchase-orders', [PurchaseOrdersController::class, 'index'])->name('purchase_orders');
    Route::get('/grn', [GrnController::class, 'index'])->name('grn');
    Route::get('/supplier-payments', [SupplierPaymentsController::class, 'index'])->name('supplier_payments');

    Route::get('/customers', [CustomersController::class, 'index'])->name('customers');
    Route::get('/sales-orders', [SalesOrdersController::class, 'index'])->name('sales_orders');
    Route::get('/invoices', [InvoicesController::class, 'index'])->name('invoices');
    Route::get('/promotions', [PromotionsController::class, 'index'])->name('promotions');

    Route::get('/gl', [GlController::class, 'index'])->name('gl');
    Route::get('/ap-ar', [ApArController::class, 'index'])->name('ap_ar');
    Route::get('/tax', [TaxController::class, 'index'])->name('tax');
    Route::get('/fin-reports', [FinReportsController::class, 'index'])->name('fin_reports');

    Route::get('/employees', [EmployeesController::class, 'index'])->name('employees');
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll');
    Route::get('/performance', [PerformanceController::class, 'index'])->name('performance');

    Route::get('/bom', [BomController::class, 'index'])->name('bom');
    Route::get('/work-orders', [WorkOrdersController::class, 'index'])->name('work_orders');
    Route::get('/machine-labor', [MachineLaborController::class, 'index'])->name('machine_labor');

    Route::get('/leads', [LeadsController::class, 'index'])->name('leads');
    Route::get('/support', [SupportController::class, 'index'])->name('support');
    Route::get('/interactions', [InteractionsController::class, 'index'])->name('interactions');

    Route::get('/tasks', [TasksController::class, 'index'])->name('tasks');
    Route::get('/resources', [ResourcesController::class, 'index'])->name('resources');
    Route::get('/project-cost', [ProjectCostController::class, 'index'])->name('project_cost');

    Route::get('/warehouses', [WarehousesController::class, 'index'])->name('warehouses');
    Route::get('/shipments', [ShipmentsController::class, 'index'])->name('shipments');
    Route::get('/routes', [RoutesController::class, 'index'])->name('routes');

    Route::get('/qc-checklists', [QcChecklistsController::class, 'index'])->name('qc_checklists');
    Route::get('/defects', [DefectsController::class, 'index'])->name('defects');
    Route::get('/compliance', [ComplianceController::class, 'index'])->name('compliance');

    Route::get('/online-channels', [OnlineChannelsController::class, 'index'])->name('online_channels');
    Route::get('/pos', [PosController::class, 'index'])->name('pos');
    Route::get('/inv-sync', [InvSyncController::class, 'index'])->name('inv_sync');

    Route::get('/custom-reports', [CustomReportsController::class, 'index'])->name('custom_reports');
    Route::get('/forecasting', [ForecastingController::class, 'index'])->name('forecasting');
    Route::get('/bi-dashboards', [BiDashboardsController::class, 'index'])->name('bi_dashboards');

    Route::get('/doc-library', [DocLibraryController::class, 'index'])->name('doc_library');
    Route::get('/doc-versions', [DocVersionsController::class, 'index'])->name('doc_versions');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
});

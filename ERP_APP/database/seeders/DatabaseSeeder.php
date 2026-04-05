<?php

namespace Database\Seeders;

use App\Models\Accounting\Tax;
use App\Models\Accounting\ApAr;
use App\Models\Accounting\FinReports;
use App\Models\Accounting\Gl;
use App\Models\Core\Dashboard;
use App\Models\Core\Settings;
use App\Models\CRM\Interactions;
use App\Models\CRM\Leads;
use App\Models\CRM\Support;
use App\Models\Documents\DocLibrary;
use App\Models\Documents\DocVersions;
use App\Models\Ecommerce\OnlineChannels;
use App\Models\Ecommerce\InvSync;
use App\Models\Ecommerce\Pos;
use App\Models\Ecommerce\PosTransactions;
use App\Models\HR\Attendance;
use App\Models\HR\Departments;
use App\Models\HR\Employees;
use App\Models\HR\Payroll;
use App\Models\HR\Performance;
use App\Models\Inventory\BatchTracking;
use App\Models\Inventory\ProductCatalog;
use App\Models\Inventory\StockMovements;
use App\Models\Inventory\StockValuation;
use App\Models\Logistics\Routes;
use App\Models\Logistics\Shipments;
use App\Models\Logistics\Warehouses;
use App\Models\Production\Bom;
use App\Models\Production\Machines;
use App\Models\Production\MachineLabor;
use App\Models\Production\WorkOrders;
use App\Models\Projects\ProjectCost;
use App\Models\Projects\Resources;
use App\Models\Projects\Tasks;
use App\Models\Purchase\Grn;
use App\Models\Purchase\GrnItems;
use App\Models\Purchase\PurchaseOrders;
use App\Models\Purchase\SupplierPayments;
use App\Models\Purchase\Suppliers;
use App\Models\QualityControl\Compliance;
use App\Models\QualityControl\Defects;
use App\Models\QualityControl\QcChecklists;
use App\Models\Reports\BiDashboards;
use App\Models\Reports\BiWidgets;
use App\Models\Reports\CustomReports;
use App\Models\Reports\Forecasting;
use App\Models\Sales\Customers;
use App\Models\Sales\Discounts;
use App\Models\Sales\Invoices;
use App\Models\Sales\Promotions;
use App\Models\Sales\SalesOrders;
use App\Models\User;
use App\Models\UsersRoles\Roles;
use Database\Factories\BatchTrackingFactory;
use Database\Factories\BiDashboardsFactory;
use Database\Factories\BiWidgetsFactory;
use Database\Factories\CustomersFactory;
use Database\Factories\ComplianceFactory;
use Database\Factories\CustomReportsFactory;
use Database\Factories\DashboardFactory;
use Database\Factories\DefectsFactory;
use Database\Factories\DepartmentsFactory;
use Database\Factories\DiscountsFactory;
use Database\Factories\DocLibraryFactory;
use Database\Factories\DocVersionsFactory;
use Database\Factories\EmployeesFactory;
use Database\Factories\FinReportsFactory;
use Database\Factories\ForecastingFactory;
use Database\Factories\GlFactory;
use Database\Factories\GrnFactory;
use Database\Factories\GrnItemsFactory;
use Database\Factories\InvoicesFactory;
use Database\Factories\InteractionsFactory;
use Database\Factories\InvSyncFactory;
use Database\Factories\LeadsFactory;
use Database\Factories\MachineLaborFactory;
use Database\Factories\MachinesFactory;
use Database\Factories\OnlineChannelsFactory;
use Database\Factories\PayrollFactory;
use Database\Factories\PerformanceFactory;
use Database\Factories\PosFactory;
use Database\Factories\PosTransactionsFactory;
use Database\Factories\ProductCatalogFactory;
use Database\Factories\ProjectCostFactory;
use Database\Factories\PromotionsFactory;
use Database\Factories\PurchaseOrdersFactory;
use Database\Factories\QcChecklistsFactory;
use Database\Factories\ResourcesFactory;
use Database\Factories\RolesFactory;
use Database\Factories\RoutesFactory;
use Database\Factories\SalesOrdersFactory;
use Database\Factories\SettingsFactory;
use Database\Factories\ShipmentsFactory;
use Database\Factories\StockMovementsFactory;
use Database\Factories\StockValuationFactory;
use Database\Factories\SupplierPaymentsFactory;
use Database\Factories\SuppliersFactory;
use Database\Factories\SupportFactory;
use Database\Factories\TasksFactory;
use Database\Factories\TaxFactory;
use Database\Factories\AttendanceFactory;
use Database\Factories\WarehousesFactory;
use Database\Factories\BomFactory;
use Database\Factories\WorkOrdersFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $roles = RolesFactory::new()->count(6)->create();
        $departments = DepartmentsFactory::new()->count(8)->create();

        $adminRole = $roles->first();
        $adminRole?->update([
            'role_name' => 'Administrator',
            'is_system_role' => true,
            'is_active' => true,
            'permissions' => Roles::getAvailablePermissions(),
        ]);

        $admin = User::factory()->create([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'role_id' => $adminRole?->id,
            'department_id' => $departments->first()?->id,
            'status' => 'active',
        ]);

        $roles->each(function (Roles $role) use ($admin): void {
            if (!$role->created_by) {
                $role->update(['created_by' => $admin->id]);
            }
        });

        User::factory()->count(24)->create();

        EmployeesFactory::new()->count(24)->create();
        $employees = Employees::all();

        $departments->each(function (Departments $department) use ($employees): void {
            $managerId = $employees->random()->id;
            $department->update(['manager_id' => $managerId]);

            Employees::query()
                ->where('department', $department->name)
                ->where('id', '!=', $managerId)
                ->inRandomOrder()
                ->limit(3)
                ->update(['manager_id' => $managerId]);
        });

        TaxFactory::new()->count(8)->create();
        OnlineChannelsFactory::new()->count(4)->create();
        WarehousesFactory::new()->count(6)->create();
        ProductCatalogFactory::new()->count(40)->create();
        CustomersFactory::new()->count(30)->create();
        SuppliersFactory::new()->count(20)->create();
        DiscountsFactory::new()->count(12)->create();
        PromotionsFactory::new()->count(8)->create();
        PurchaseOrdersFactory::new()->count(18)->create();
        SalesOrdersFactory::new()->count(24)->create();
        InvoicesFactory::new()->count(20)->create();
        StockMovementsFactory::new()->count(40)->create();
        StockValuationFactory::new()->count(30)->create();
        BatchTrackingFactory::new()->count(35)->create();
        MachinesFactory::new()->count(10)->create();
        BomFactory::new()->count(12)->create();
        WorkOrdersFactory::new()->count(20)->create();
        MachineLaborFactory::new()->count(20)->create();
        AttendanceFactory::new()->count(60)->create();
        PayrollFactory::new()->count(24)->create();
        PerformanceFactory::new()->count(24)->create();
        ComplianceFactory::new()->count(16)->create();
        DefectsFactory::new()->count(24)->create();
        QcChecklistsFactory::new()->count(20)->create();
        TasksFactory::new()->count(20)->create();
        ProjectCostFactory::new()->count(24)->create();
        ResourcesFactory::new()->count(24)->create();
        DocLibraryFactory::new()->count(16)->create();
        DocVersionsFactory::new()->count(24)->create();
        LeadsFactory::new()->count(24)->create();
        SupportFactory::new()->count(20)->create();
        InteractionsFactory::new()->count(30)->create();
        RoutesFactory::new()->count(12)->create();
        ShipmentsFactory::new()->count(20)->create();
        GrnFactory::new()->count(18)->create();
        GrnItemsFactory::new()->count(36)->create();
        SupplierPaymentsFactory::new()->count(18)->create();
        PosFactory::new()->count(8)->create();
        PosTransactionsFactory::new()->count(40)->create();
        InvSyncFactory::new()->count(24)->create();
        DashboardFactory::new()->count(12)->create();
        SettingsFactory::new()->count(20)->create();
        GlFactory::new()->count(20)->create();
        \Database\Factories\ApArFactory::new()->count(24)->create();
        FinReportsFactory::new()->count(12)->create();
        CustomReportsFactory::new()->count(12)->create();
        ForecastingFactory::new()->count(12)->create();
        BiDashboardsFactory::new()->count(8)->create();
        BiWidgetsFactory::new()->count(20)->create();

        $this->attachOrderReferencesToInvoices();
        $this->attachOrderReferencesToPosTransactions();
        $this->syncWidgetsToDashboards();
    }

    protected function attachOrderReferencesToInvoices(): void
    {
        $salesOrderIds = SalesOrders::query()->pluck('id');

        if ($salesOrderIds->isEmpty()) {
            return;
        }

        Invoices::query()->get()->each(function (Invoices $invoice) use ($salesOrderIds): void {
            Invoices::query()
                ->whereKey($invoice->id)
                ->update(['sales_order_id' => $salesOrderIds->random()]);
        });
    }

    protected function attachOrderReferencesToPosTransactions(): void
    {
        $salesOrderIds = SalesOrders::query()->pluck('id');

        if ($salesOrderIds->isEmpty()) {
            return;
        }

        PosTransactions::query()->get()->each(function (PosTransactions $transaction) use ($salesOrderIds): void {
            $transaction->update([
                'order_reference' => fake()->boolean(65) ? $salesOrderIds->random() : null,
            ]);
        });
    }

    protected function syncWidgetsToDashboards(): void
    {
        BiDashboards::query()->get()->each(function (BiDashboards $dashboard): void {
            $widgetIds = BiWidgets::query()
                ->where('dashboard_id', $dashboard->id)
                ->pluck('id')
                ->values()
                ->all();

            $dashboard->update(['widgets' => $widgetIds]);
        });
    }
}

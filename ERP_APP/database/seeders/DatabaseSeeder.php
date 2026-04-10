<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            // Level 1: Base tables (no FK)
            UsersRoles\RolesSeeder::class,
            Purchase\SuppliersSeeder::class,
            HR\EmployeesSeeder::class,
            Sales\PromotionsSeeder::class,
            Accounting\GlSeeder::class,
            Accounting\TaxSeeder::class,
            Logistics\RoutesSeeder::class,
            Ecommerce\OnlineChannelsSeeder::class,
            QualityControl\ComplianceSeeder::class,

            // Level 2: Depends on Level 1
            UsersRoles\UserSeeder::class,                 // FK: role_id -> Roles
            Logistics\WarehousesSeeder::class,            // FK: manager_id -> User
            Sales\CustomersSeeder::class,                 // FK: sales_rep_id -> User

            // Level 3: Depends on Level 2
            Inventory\ProductCatalogSeeder::class,        // FK: warehouse_id -> Warehouses
            Purchase\PurchaseOrdersSeeder::class,       // FK: supplier_id -> Suppliers, warehouse_id -> Warehouses

            // Level 4: Depends on Level 3
            Sales\SalesOrdersSeeder::class,               // FK: customer_id -> Customers
            Sales\InvoicesSeeder::class,                 // FK: customer_id -> Customers
            Inventory\StockMovementsSeeder::class,      // FK: product_id -> ProductCatalog, warehouse_id -> Warehouses
            Inventory\BatchTrackingSeeder::class,       // FK: product_id -> ProductCatalog
            Inventory\StockValuationSeeder::class,      // FK: product_id -> ProductCatalog
            Purchase\GrnSeeder::class,                   // FK: purchase_order_id -> PurchaseOrders, warehouse_id -> Warehouses

            // Level 5: Depends on Level 3 & 4
            Purchase\SupplierPaymentsSeeder::class,     // FK: supplier_id -> Suppliers
            Production\BomSeeder::class,                 // no FK
            Production\WorkOrdersSeeder::class,         // FK: bom_id -> Bom
            Production\MachineLaborSeeder::class,       // FK: work_order_id -> WorkOrders

            // Level 6: Depends on Employees
            HR\PayrollSeeder::class,                     // FK: employee_id -> Employees
            HR\AttendanceSeeder::class,                  // FK: employee_id -> Employees
            HR\PerformanceSeeder::class,                 // FK: employee_id -> Employees

            // Level 7: No dependencies
            Accounting\ApArSeeder::class,
            Accounting\FinReportsSeeder::class,
            Logistics\ShipmentsSeeder::class,           // FK: sales_order_id -> SalesOrders
            Ecommerce\PosSeeder::class,                  // FK: assigned_cashier_id -> User, warehouse_id -> Warehouses
            Ecommerce\InvSyncSeeder::class,              // FK: channel_id -> OnlineChannels
            CRM\LeadsSeeder::class,                      // FK: assigned_user_id -> User

            // Level 8: Depends on Customers & User
            CRM\InteractionsSeeder::class,               // FK: customer_id -> Customers
            CRM\SupportSeeder::class,                    // FK: customer_id -> Customers, assigned_user_id -> User
            QualityControl\QcChecklistsSeeder::class,    // FK: inspector_id -> User
            QualityControl\DefectsSeeder::class,         // FK: product_id -> ProductCatalog
            Documents\DocLibrarySeeder::class,          // FK: uploaded_by_user_id -> User

            // Level 9: Depends on Employees
            Projects\ResourcesSeeder::class,             // FK: employee_id -> Employees

            // Level 10: Depends on User
            Projects\TasksSeeder::class,                 // FK: assigned_user_id -> User
            Projects\ProjectCostSeeder::class,           // FK: approved_by_user_id -> User

            // Level 11: Depends on DocLibrary
            Documents\DocVersionsSeeder::class,         // FK: document_id -> DocLibrary, changed_by_user_id -> User, approver_id -> User

            // Level 12: Depends on Warehouses
            Core\SettingsSeeder::class,                   // FK: default_warehouse_id -> Warehouses
            Core\DashboardSeeder::class,
            Reports\BiDashboardsSeeder::class,           // FK: created_by_user_id -> User
            Reports\CustomReportsSeeder::class,
            Reports\ForecastingSeeder::class,
        ]);
    }
}

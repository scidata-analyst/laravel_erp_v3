<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

$seeders = [
    // Level 1: Independent tables
    "RolesSeeder", "TaxSeeder", "UserSeeder", "EmployeesSeeder", "ProductCatalogSeeder",
    "SuppliersSeeder", "CustomersSeeder", "DiscountsSeeder", "SettingsSeeder", "BOMSeeder",
    "TasksSeeder", "BiDashboardsSeeder", "OnlineChannelsSeeder", "DocLibrarySeeder", "LeadsSeeder",

    // Level 2: Depends on Level 1
    "WarehousesSeeder", "PurchaseOrdersSeeder", "SalesOrdersSeeder", "AttendanceSeeder",
    "PayrollSeeder", "PerformanceSeeder", "InvoicesSeeder", "PromotionsSeeder", "StockMovementsSeeder",
    "StockValuationSeeder", "BatchTrackingSeeder", "WorkOrdersSeeder", "DocVersionsSeeder",
    "PosSeeder", "DashboardSeeder", "SupportSeeder", "BiWidgetsSeeder", "GlSeeder", "ApArSeeder",
    "FinReportsSeeder", "CustomReportsSeeder", "ForecastingSeeder",

    // Level 3: Depends on Level 2
    "GrnSeeder", "SupplierPaymentsSeeder", "ShipmentsSeeder", "RoutesSeeder", "MachineLaborSeeder",
    "DefectsSeeder", "CompliancesSeeder", "QcChecklistsSeeder", "ProjectCostSeeder",
    "ProjectResourcesSeeder", "PosTransactionsSeeder", "InvSyncSeeder", "InteractionsSeeder",

    // Level 4: Depends on Level 3
    "GrnItemsSeeder"
];

$errors = [];

Artisan::call('migrate:fresh');

foreach ($seeders as $seeder) {
    try {
        Artisan::call("db:seed", ["--class" => "Database\\Seeders\\{$seeder}"]);
    } catch (\Throwable $e) {
        $errors[$seeder] = $e->getMessage();
    }
}

file_put_contents('seeder_errors.json', json_encode($errors, JSON_PRETTY_PRINT));
echo "Done testing. Found " . count($errors) . " errors.\n";

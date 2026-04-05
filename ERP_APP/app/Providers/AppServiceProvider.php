<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Interfaces\Inventory\ProductCatalogInterface::class,
            \App\Repositories\Inventory\ProductCatalogRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Inventory\StockMovementsInterface::class,
            \App\Repositories\Inventory\StockMovementsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Inventory\BatchTrackingInterface::class,
            \App\Repositories\Inventory\BatchTrackingRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Inventory\StockValuationInterface::class,
            \App\Repositories\Inventory\StockValuationRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Sales\CustomersInterface::class,
            \App\Repositories\Sales\CustomersRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Sales\SalesOrdersInterface::class,
            \App\Repositories\Sales\SalesOrdersRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Sales\InvoicesInterface::class,
            \App\Repositories\Sales\InvoicesRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Sales\PromotionsInterface::class,
            \App\Repositories\Sales\PromotionsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Sales\DiscountsInterface::class,
            \App\Repositories\Sales\DiscountsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Purchase\SuppliersInterface::class,
            \App\Repositories\Purchase\SuppliersRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Purchase\PurchaseOrdersInterface::class,
            \App\Repositories\Purchase\PurchaseOrdersRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Purchase\GrnInterface::class,
            \App\Repositories\Purchase\GrnRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Purchase\SupplierPaymentsInterface::class,
            \App\Repositories\Purchase\SupplierPaymentsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Accounting\GlInterface::class,
            \App\Repositories\Accounting\GlRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Accounting\ApArInterface::class,
            \App\Repositories\Accounting\ApArRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Accounting\TaxInterface::class,
            \App\Repositories\Accounting\TaxRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Accounting\FinReportsInterface::class,
            \App\Repositories\Accounting\FinReportsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\HR\EmployeesInterface::class,
            \App\Repositories\HR\EmployeesRepository::class
        );

        $this->app->bind(
            \App\Interfaces\HR\PayrollInterface::class,
            \App\Repositories\HR\PayrollRepository::class
        );

        $this->app->bind(
            \App\Interfaces\HR\AttendanceInterface::class,
            \App\Repositories\HR\AttendanceRepository::class
        );

        $this->app->bind(
            \App\Interfaces\HR\PerformanceInterface::class,
            \App\Repositories\HR\PerformanceRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Production\WorkOrdersInterface::class,
            \App\Repositories\Production\WorkOrdersRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Production\BomInterface::class,
            \App\Repositories\Production\BomRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Production\MachineLaborInterface::class,
            \App\Repositories\Production\MachineLaborRepository::class
        );

        $this->app->bind(
            \App\Interfaces\CRM\LeadsInterface::class,
            \App\Repositories\CRM\LeadsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\CRM\InteractionsInterface::class,
            \App\Repositories\CRM\InteractionsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\CRM\SupportInterface::class,
            \App\Repositories\CRM\SupportRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Projects\TasksInterface::class,
            \App\Repositories\Projects\TasksRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Projects\ProjectCostInterface::class,
            \App\Repositories\Projects\ProjectCostRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Projects\ResourcesInterface::class,
            \App\Repositories\Projects\ResourcesRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Logistics\WarehousesInterface::class,
            \App\Repositories\Logistics\WarehousesRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Logistics\ShipmentsInterface::class,
            \App\Repositories\Logistics\ShipmentsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Logistics\RoutesInterface::class,
            \App\Repositories\Logistics\RoutesRepository::class
        );

        $this->app->bind(
            \App\Interfaces\QualityControl\QcChecklistsInterface::class,
            \App\Repositories\QualityControl\QcChecklistsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\QualityControl\DefectsInterface::class,
            \App\Repositories\QualityControl\DefectsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\QualityControl\ComplianceInterface::class,
            \App\Repositories\QualityControl\ComplianceRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Ecommerce\PosTransactionsInterface::class,
            \App\Repositories\Ecommerce\PosTransactionsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Ecommerce\PosInterface::class,
            \App\Repositories\Ecommerce\PosRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Ecommerce\OnlineChannelsInterface::class,
            \App\Repositories\Ecommerce\OnlineChannelsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Ecommerce\InvSyncInterface::class,
            \App\Repositories\Ecommerce\InvSyncRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Reports\CustomReportsInterface::class,
            \App\Repositories\Reports\CustomReportsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Reports\BiDashboardsInterface::class,
            \App\Repositories\Reports\BiDashboardsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Reports\BiWidgetsInterface::class,
            \App\Repositories\Reports\BiWidgetsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Reports\ForecastingInterface::class,
            \App\Repositories\Reports\ForecastingRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Documents\DocLibraryInterface::class,
            \App\Repositories\Documents\DocLibraryRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Documents\DocVersionsInterface::class,
            \App\Repositories\Documents\DocVersionsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Core\SettingsInterface::class,
            \App\Repositories\Core\SettingsRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Core\DashboardInterface::class,
            \App\Repositories\Core\DashboardRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Auth\UserInterface::class,
            \App\Repositories\Auth\UserRepository::class
        );

        $this->app->bind(
            \App\Interfaces\Auth\RolesInterface::class,
            \App\Repositories\Auth\RolesRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Bootstrap application services here
    }
}

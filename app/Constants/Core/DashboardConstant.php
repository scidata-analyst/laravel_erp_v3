<?php

namespace App\Constants\Core;

/**
 * Class DashboardConstant
 *
 * Central constants for Dashboard Core.
 * Can be used for configuration, table names, or CRUD references.
 */
class DashboardConstant
{
    /**
     * Example: reference to Dashboard model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Core\\Dashboard';

    /**
     * Example: table name of Dashboard
     *
     * @var string
     */
    public const TABLE = 'Dashboard_TABLE';

    /**
     * Example: default items per page for Dashboard listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for Dashboard Core.
     */
    public const WIDGET_SALES = 1;

    public const WIDGET_PURCHASE = 2;

    public const WIDGET_INVENTORY = 3;

    public const WIDGET_FINANCE = 4;

    public const WIDGET_HR = 5;

    public const REFRESH_REALTIME = 1;

    public const REFRESH_5_MIN = 2;

    public const REFRESH_15_MIN = 3;

    public const REFRESH_HOURLY = 4;

    public function getWidgetTypes(): array
    {
        return [
            self::WIDGET_SALES => 'Sales',
            self::WIDGET_PURCHASE => 'Purchase',
            self::WIDGET_INVENTORY => 'Inventory',
            self::WIDGET_FINANCE => 'Finance',
            self::WIDGET_HR => 'HR',
        ];
    }

    public function getRefreshRates(): array
    {
        return [
            self::REFRESH_REALTIME => 'Real-time',
            self::REFRESH_5_MIN => 'Every 5 min',
            self::REFRESH_15_MIN => 'Every 15 min',
            self::REFRESH_HOURLY => 'Hourly',
        ];
    }
}

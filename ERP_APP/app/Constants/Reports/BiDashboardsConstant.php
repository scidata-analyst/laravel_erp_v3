<?php

namespace App\Constants\Reports;

/**
 * Class BiDashboardsConstant
 *
 * Central constants for BiDashboards Reports.
 * Can be used for configuration, table names, or CRUD references.
 */
class BiDashboardsConstant
{
    /**
     * Example: reference to BiDashboards model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Reports\\BiDashboards';

    /**
     * Example: table name of BiDashboards
     *
     * @var string
     */
    public const TABLE = 'BiDashboards_TABLE';

    /**
     * Example: default items per page for BiDashboards listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for BiDashboards Reports.
     */
    public const CHART_TYPE_BAR = 1;

    public const CHART_TYPE_LINE = 2;

    public const CHART_TYPE_PIE = 3;

    public const CHART_TYPE_KPI = 4;

    public const CHART_TYPE_TABLE = 5;

    public const CHART_TYPE_MAP = 6;

    public const REFRESH_REALTIME = 1;

    public const REFRESH_HOURLY = 2;

    public const REFRESH_DAILY = 3;

    public function getChartTypes(): array
    {
        return [
            self::CHART_TYPE_BAR => 'Bar Chart',
            self::CHART_TYPE_LINE => 'Line Chart',
            self::CHART_TYPE_PIE => 'Pie/Donut',
            self::CHART_TYPE_KPI => 'KPI Tile',
            self::CHART_TYPE_TABLE => 'Table',
            self::CHART_TYPE_MAP => 'Map',
        ];
    }

    public function getRefreshRates(): array
    {
        return [
            self::REFRESH_REALTIME => 'Real-time',
            self::REFRESH_HOURLY => 'Hourly',
            self::REFRESH_DAILY => 'Daily',
        ];
    }
}

<?php

namespace App\Constants\Reports;

/**
 * Class CustomReportsConstant
 *
 * Central constants for CustomReports Reports.
 * Can be used for configuration, table names, or CRUD references.
 */
class CustomReportsConstant
{
    /**
     * Example: reference to CustomReports model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Reports\\CustomReports';

    /**
     * Example: table name of CustomReports
     *
     * @var string
     */
    public const TABLE = 'CustomReports_TABLE';

    /**
     * Example: default items per page for CustomReports listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for CustomReports Reports.
     */
    public const MODULE_SALES = 1;

    public const MODULE_PURCHASE = 2;

    public const MODULE_INVENTORY = 3;

    public const MODULE_FINANCE = 4;

    public const MODULE_HR = 5;

    public const FILTER_DATE_RANGE = 1;

    public const FILTER_STATUS = 2;

    public const FILTER_DEPARTMENT = 3;

    public const SCHEDULE_MANUAL = 1;

    public const SCHEDULE_DAILY = 2;

    public const SCHEDULE_WEEKLY = 3;

    public const SCHEDULE_MONTHLY = 4;

    public const FORMAT_PDF = 1;

    public const FORMAT_EXCEL = 2;

    public const FORMAT_BOTH = 3;

    public function getModules(): array
    {
        return [
            self::MODULE_SALES => 'Sales',
            self::MODULE_PURCHASE => 'Purchase',
            self::MODULE_INVENTORY => 'Inventory',
            self::MODULE_FINANCE => 'Finance',
            self::MODULE_HR => 'HR',
        ];
    }

    public function getFilterTypes(): array
    {
        return [
            self::FILTER_DATE_RANGE => 'Date Range',
            self::FILTER_STATUS => 'Status',
            self::FILTER_DEPARTMENT => 'Department',
        ];
    }

    public function getSchedules(): array
    {
        return [
            self::SCHEDULE_MANUAL => 'Manual',
            self::SCHEDULE_DAILY => 'Daily',
            self::SCHEDULE_WEEKLY => 'Weekly',
            self::SCHEDULE_MONTHLY => 'Monthly',
        ];
    }

    public function getOutputFormats(): array
    {
        return [
            self::FORMAT_PDF => 'PDF',
            self::FORMAT_EXCEL => 'Excel',
            self::FORMAT_BOTH => 'Both',
        ];
    }
}

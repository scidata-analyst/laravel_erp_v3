<?php

namespace App\Constants\Accounting;

/**
 * Class FinReportsConstant
 *
 * Central constants for FinReports Accounting.
 * Can be used for configuration, table names, or CRUD references.
 */
class FinReportsConstant
{
    /**
     * Example: reference to FinReports model
     *
     * @var string
     */
    public const MODEL = "App\\Models\\Accounting\\FinReports";

    /**
     * Example: table name of FinReports
     *
     * @var string
     */
    public const TABLE = "FinReports_TABLE";

    /**
     * Example: default items per page for FinReports listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for FinReports Accounting.
     */

    
    public const REPORT_TYPE_PROFIT_LOSS = 1;
    public const REPORT_TYPE_BALANCE_SHEET = 2;
    public const REPORT_TYPE_CASH_FLOW = 3;
    public const REPORT_TYPE_INCOME_STATEMENT = 4;

    public const PERIOD_THIS_MONTH = 1;
    public const PERIOD_LAST_MONTH = 2;
    public const PERIOD_THIS_QUARTER = 3;
    public const PERIOD_CUSTOM = 4;

    public function getReportTypes(): array
    {
        return [
            self::REPORT_TYPE_PROFIT_LOSS => "Profit & Loss",
            self::REPORT_TYPE_BALANCE_SHEET => "Balance Sheet",
            self::REPORT_TYPE_CASH_FLOW => "Cash Flow",
            self::REPORT_TYPE_INCOME_STATEMENT => "Income Statement",
        ];
    }

    public function getPeriods(): array
    {
        return [
            self::PERIOD_THIS_MONTH => "This Month",
            self::PERIOD_LAST_MONTH => "Last Month",
            self::PERIOD_THIS_QUARTER => "This Quarter",
            self::PERIOD_CUSTOM => "Custom",
        ];
    }
}

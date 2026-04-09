<?php

namespace App\Constants\Reports;

/**
 * Class ForecastingConstant
 *
 * Central constants for Forecasting Reports.
 * Can be used for configuration, table names, or CRUD references.
 */
class ForecastingConstant
{
    /**
     * Example: reference to Forecasting model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Reports\\Forecasting';

    /**
     * Example: table name of Forecasting
     *
     * @var string
     */
    public const TABLE = 'Forecasting_TABLE';

    /**
     * Example: default items per page for Forecasting listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for Forecasting Reports.
     */
    public const TYPE_SALES = 1;

    public const TYPE_INVENTORY = 2;

    public const TYPE_REVENUE = 3;

    public const TYPE_EXPENSE = 4;

    public const MODEL_MOVING_AVERAGE = 1;

    public const MODEL_LINEAR_REGRESSION = 2;

    public const MODEL_EXPONENTIAL_SMOOTHING = 3;

    public const STATUS_ACTIVE = 1;

    public const STATUS_ARCHIVED = 2;

    public function getForecastTypes(): array
    {
        return [
            self::TYPE_SALES => 'Sales',
            self::TYPE_INVENTORY => 'Inventory',
            self::TYPE_REVENUE => 'Revenue',
            self::TYPE_EXPENSE => 'Expense',
        ];
    }

    public function getModels(): array
    {
        return [
            self::MODEL_MOVING_AVERAGE => 'Moving Average',
            self::MODEL_LINEAR_REGRESSION => 'Linear Regression',
            self::MODEL_EXPONENTIAL_SMOOTHING => 'Exponential Smoothing',
        ];
    }

    public function getStatuses(): array
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_ARCHIVED => 'Archived',
        ];
    }
}

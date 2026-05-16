<?php

namespace App\Constants\Sales;

/**
 * Class SalesOrdersConstant
 *
 * Central constants for SalesOrders Sales.
 * Can be used for configuration, table names, or CRUD references.
 */
class SalesOrdersConstant
{
    /**
     * Example: reference to SalesOrders model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Sales\\SalesOrders';

    /**
     * Example: table name of SalesOrders
     *
     * @var string
     */
    public const TABLE = 'SalesOrders_TABLE';

    /**
     * Example: default items per page for SalesOrders listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const STATUS_PENDING = 1;

    public const STATUS_CONFIRMED = 2;

    public const STATUS_DISPATCHED = 3;

    public const STATUS_DELIVERED = 4;

    public function getStatuses(): array
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_DISPATCHED => 'Dispatched',
            self::STATUS_DELIVERED => 'Delivered',
        ];
    }
}

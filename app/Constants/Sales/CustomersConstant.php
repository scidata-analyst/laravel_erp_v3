<?php

namespace App\Constants\Sales;

/**
 * Class CustomersConstant
 *
 * Central constants for Customers Sales.
 * Can be used for configuration, table names, or CRUD references.
 */
class CustomersConstant
{
    /**
     * Example: reference to Customers model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Sales\\Customers';

    /**
     * Example: table name of Customers
     *
     * @var string
     */
    public const TABLE = 'Customers_TABLE';

    /**
     * Example: default items per page for Customers listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const STATUS_ACTIVE = 1;

    public const STATUS_BLOCKED = 2;

    public function getStatuses(): array
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_BLOCKED => 'Blocked',
        ];
    }
}

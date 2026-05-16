<?php

namespace App\Constants\Inventory;

/**
 * Class ProductCatalogConstant
 *
 * Central constants for ProductCatalog Inventory.
 * Can be used for configuration, table names, or CRUD references.
 */
class ProductCatalogConstant
{
    /**
     * Example: reference to ProductCatalog model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Inventory\\ProductCatalog';

    /**
     * Example: table name of ProductCatalog
     *
     * @var string
     */
    public const TABLE = 'ProductCatalog_TABLE';

    /**
     * Example: default items per page for ProductCatalog listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const VALUATION_FIFO = 1;

    public const VALUATION_LIFO = 2;

    public const VALUATION_AVERAGE_COST = 3;

    public function getValuationMethods(): array
    {
        return [
            self::VALUATION_FIFO => 'FIFO',
            self::VALUATION_LIFO => 'LIFO',
            self::VALUATION_AVERAGE_COST => 'Average Cost',
        ];
    }
}

<?php

namespace App\Constants\Inventory;

/**
 * Class StockValuationConstant
 *
 * Central constants for StockValuation Inventory.
 * Can be used for configuration, table names, or CRUD references.
 */
class StockValuationConstant
{
    /**
     * Example: reference to StockValuation model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Inventory\\StockValuation';

    /**
     * Example: table name of StockValuation
     *
     * @var string
     */
    public const TABLE = 'StockValuation_TABLE';

    /**
     * Example: default items per page for StockValuation listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const METHOD_FIFO = 1;

    public const METHOD_LIFO = 2;

    public const METHOD_AVERAGE = 3;

    public function getValuationMethods(): array
    {
        return [
            self::METHOD_FIFO => 'FIFO',
            self::METHOD_LIFO => 'LIFO',
            self::METHOD_AVERAGE => 'Average Cost',
        ];
    }
}

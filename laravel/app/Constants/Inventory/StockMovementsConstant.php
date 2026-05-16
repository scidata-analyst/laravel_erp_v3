<?php

namespace App\Constants\Inventory;

/**
 * Class StockMovementsConstant
 *
 * Central constants for StockMovements Inventory.
 * Can be used for configuration, table names, or CRUD references.
 */
class StockMovementsConstant
{
    /**
     * Example: reference to StockMovements model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Inventory\\StockMovements';

    /**
     * Example: table name of StockMovements
     *
     * @var string
     */
    public const TABLE = 'StockMovements_TABLE';

    /**
     * Example: default items per page for StockMovements listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const TYPE_STOCK_IN = 1;

    public const TYPE_STOCK_OUT = 2;

    public const TYPE_TRANSFER = 3;

    public function getMovementTypes(): array
    {
        return [
            self::TYPE_STOCK_IN => 'Stock In',
            self::TYPE_STOCK_OUT => 'Stock Out',
            self::TYPE_TRANSFER => 'Transfer',
        ];
    }
}

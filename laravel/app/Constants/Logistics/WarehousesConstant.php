<?php

namespace App\Constants\Logistics;

/**
 * Class WarehousesConstant
 *
 * Central constants for Warehouses Logistics.
 * Can be used for configuration, table names, or CRUD references.
 */
class WarehousesConstant
{
    /**
     * Example: reference to Warehouses model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Logistics\\Warehouses';

    /**
     * Example: table name of Warehouses
     *
     * @var string
     */
    public const TABLE = 'Warehouses_TABLE';

    /**
     * Example: default items per page for Warehouses listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for Warehouses Logistics.
     */
    public const TYPE_STANDARD = 1;

    public const TYPE_COLD_STORAGE = 2;

    public const TYPE_BONDED = 3;

    public const STATUS_ACTIVE = 1;

    public const STATUS_INACTIVE = 2;

    public function getTypes(): array
    {
        return [
            self::TYPE_STANDARD => 'Standard',
            self::TYPE_COLD_STORAGE => 'Cold Storage',
            self::TYPE_BONDED => 'Bonded',
        ];
    }

    public function getStatuses(): array
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }
}

<?php

namespace App\Constants\Logistics;

/**
 * Class RoutesConstant
 *
 * Central constants for Routes Logistics.
 * Can be used for configuration, table names, or CRUD references.
 */
class RoutesConstant
{
    /**
     * Example: reference to Routes model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Logistics\\Routes';

    /**
     * Example: table name of Routes
     *
     * @var string
     */
    public const TABLE = 'Routes_TABLE';

    /**
     * Example: default items per page for Routes listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for Routes Logistics.
     */
    public const STATUS_ACTIVE = 1;

    public const STATUS_INACTIVE = 2;

    public function getStatuses(): array
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }
}

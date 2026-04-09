<?php

namespace App\Constants\Inventory;

/**
 * Class BatchTrackingConstant
 *
 * Central constants for BatchTracking Inventory.
 * Can be used for configuration, table names, or CRUD references.
 */
class BatchTrackingConstant
{
    /**
     * Example: reference to BatchTracking model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Inventory\\BatchTracking';

    /**
     * Example: table name of BatchTracking
     *
     * @var string
     */
    public const TABLE = 'BatchTracking_TABLE';

    /**
     * Example: default items per page for BatchTracking listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const STATUS_ACTIVE = 1;

    public const STATUS_PENDING = 2;

    public const STATUS_EXPIRED = 3;

    public function getStatuses(): array
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_PENDING => 'Pending',
            self::STATUS_EXPIRED => 'Expired',
        ];
    }
}

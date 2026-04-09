<?php

namespace App\Constants\Ecommerce;

/**
 * Class PosConstant
 *
 * Central constants for Pos Ecommerce.
 * Can be used for configuration, table names, or CRUD references.
 */
class PosConstant
{
    /**
     * Example: reference to Pos model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Ecommerce\\Pos';

    /**
     * Example: table name of Pos
     *
     * @var string
     */
    public const TABLE = 'Pos_TABLE';

    /**
     * Example: default items per page for Pos listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for Pos Ecommerce.
     */
    public const STATUS_ONLINE = 1;

    public const STATUS_OFFLINE = 2;

    public const STATUS_CLOSED = 3;

    public function getStatuses(): array
    {
        return [
            self::STATUS_ONLINE => 'Online',
            self::STATUS_OFFLINE => 'Offline',
            self::STATUS_CLOSED => 'Closed',
        ];
    }
}

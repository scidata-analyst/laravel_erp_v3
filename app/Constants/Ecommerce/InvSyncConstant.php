<?php

namespace App\Constants\Ecommerce;

/**
 * Class InvSyncConstant
 *
 * Central constants for InvSync Ecommerce.
 * Can be used for configuration, table names, or CRUD references.
 */
class InvSyncConstant
{
    /**
     * Example: reference to InvSync model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Ecommerce\\InvSync';

    /**
     * Example: table name of InvSync
     *
     * @var string
     */
    public const TABLE = 'InvSync_TABLE';

    /**
     * Example: default items per page for InvSync listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for InvSync Ecommerce.
     */
    public const SYNC_STATUS_SYNCED = 1;

    public const SYNC_STATUS_OUT_OF_SYNC = 2;

    public const SYNC_STATUS_ERROR = 3;

    public const SYNC_FREQUENCY_15_MIN = 1;

    public const SYNC_FREQUENCY_HOURLY = 2;

    public const SYNC_FREQUENCY_DAILY = 3;

    public function getSyncStatuses(): array
    {
        return [
            self::SYNC_STATUS_SYNCED => 'Synced',
            self::SYNC_STATUS_OUT_OF_SYNC => 'Out of Sync',
            self::SYNC_STATUS_ERROR => 'Error',
        ];
    }

    public function getSyncFrequencies(): array
    {
        return [
            self::SYNC_FREQUENCY_15_MIN => 'Every 15 min',
            self::SYNC_FREQUENCY_HOURLY => 'Every hour',
            self::SYNC_FREQUENCY_DAILY => 'Daily',
        ];
    }
}

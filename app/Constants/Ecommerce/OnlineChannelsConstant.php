<?php

namespace App\Constants\Ecommerce;

/**
 * Class OnlineChannelsConstant
 *
 * Central constants for OnlineChannels Ecommerce.
 * Can be used for configuration, table names, or CRUD references.
 */
class OnlineChannelsConstant
{
    /**
     * Example: reference to OnlineChannels model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Ecommerce\\OnlineChannels';

    /**
     * Example: table name of OnlineChannels
     *
     * @var string
     */
    public const TABLE = 'OnlineChannels_TABLE';

    /**
     * Example: default items per page for OnlineChannels listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for OnlineChannels Ecommerce.
     */
    public const PLATFORM_SHOPIFY = 1;

    public const PLATFORM_WOOCOMMERCE = 2;

    public const PLATFORM_DARAZ = 3;

    public const PLATFORM_FACEBOOK = 4;

    public const SYNC_FREQUENCY_15_MIN = 1;

    public const SYNC_FREQUENCY_HOURLY = 2;

    public const SYNC_FREQUENCY_DAILY = 3;

    public const STATUS_ACTIVE = 1;

    public const STATUS_INACTIVE = 2;

    public function getPlatforms(): array
    {
        return [
            self::PLATFORM_SHOPIFY => 'Shopify',
            self::PLATFORM_WOOCOMMERCE => 'WooCommerce',
            self::PLATFORM_DARAZ => 'Daraz',
            self::PLATFORM_FACEBOOK => 'Facebook Shop',
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

    public function getStatuses(): array
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }
}

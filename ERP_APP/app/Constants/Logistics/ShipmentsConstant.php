<?php

namespace App\Constants\Logistics;

/**
 * Class ShipmentsConstant
 *
 * Central constants for Shipments Logistics.
 * Can be used for configuration, table names, or CRUD references.
 */
class ShipmentsConstant
{
    /**
     * Example: reference to Shipments model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Logistics\\Shipments';

    /**
     * Example: table name of Shipments
     *
     * @var string
     */
    public const TABLE = 'Shipments_TABLE';

    /**
     * Example: default items per page for Shipments listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for Shipments Logistics.
     */
    public const STATUS_PREPARING = 1;

    public const STATUS_DISPATCHED = 2;

    public const STATUS_IN_TRANSIT = 3;

    public const STATUS_DELIVERED = 4;

    public const STATUS_FAILED = 5;

    public const CARRIER_DHL = 1;

    public const CARRIER_FEDEX = 2;

    public const CARRIER_UPS = 3;

    public const CARRIER_LOCAL_COURIER = 4;

    public function getStatuses(): array
    {
        return [
            self::STATUS_PREPARING => 'Preparing',
            self::STATUS_DISPATCHED => 'Dispatched',
            self::STATUS_IN_TRANSIT => 'In Transit',
            self::STATUS_DELIVERED => 'Delivered',
            self::STATUS_FAILED => 'Failed',
        ];
    }

    public function getCarriers(): array
    {
        return [
            self::CARRIER_DHL => 'DHL',
            self::CARRIER_FEDEX => 'FedEx',
            self::CARRIER_UPS => 'UPS',
            self::CARRIER_LOCAL_COURIER => 'Local Courier',
        ];
    }
}

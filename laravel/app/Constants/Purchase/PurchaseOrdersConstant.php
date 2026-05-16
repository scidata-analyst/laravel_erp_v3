<?php

namespace App\Constants\Purchase;

/**
 * Class PurchaseOrdersConstant
 *
 * Central constants for PurchaseOrders Purchase.
 * Can be used for configuration, table names, or CRUD references.
 */
class PurchaseOrdersConstant
{
    /**
     * Example: reference to PurchaseOrders model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Purchase\\PurchaseOrders';

    /**
     * Example: table name of PurchaseOrders
     *
     * @var string
     */
    public const TABLE = 'PurchaseOrders_TABLE';

    /**
     * Example: default items per page for PurchaseOrders listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const STATUS_DRAFT = 1;

    public const STATUS_PENDING = 2;

    public const STATUS_APPROVED = 3;

    public const STATUS_RECEIVED = 4;

    public function getStatuses(): array
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_PENDING => 'Pending',
            self::STATUS_APPROVED => 'Approved',
            self::STATUS_RECEIVED => 'Received',
        ];
    }
}

<?php

namespace App\Constants\Purchase;

/**
 * Class SupplierPaymentsConstant
 *
 * Central constants for SupplierPayments Purchase.
 * Can be used for configuration, table names, or CRUD references.
 */
class SupplierPaymentsConstant
{
    /**
     * Example: reference to SupplierPayments model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Purchase\\SupplierPayments';

    /**
     * Example: table name of SupplierPayments
     *
     * @var string
     */
    public const TABLE = 'SupplierPayments_TABLE';

    /**
     * Example: default items per page for SupplierPayments listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const STATUS_PAID = 1;

    public const STATUS_PENDING = 2;

    public const STATUS_OVERDUE = 3;

    public function getStatuses(): array
    {
        return [
            self::STATUS_PAID => 'Paid',
            self::STATUS_PENDING => 'Pending',
            self::STATUS_OVERDUE => 'Overdue',
        ];
    }
}

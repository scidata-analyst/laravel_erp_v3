<?php

namespace App\Constants\Sales;

/**
 * Class InvoicesConstant
 *
 * Central constants for Invoices Sales.
 * Can be used for configuration, table names, or CRUD references.
 */
class InvoicesConstant
{
    /**
     * Example: reference to Invoices model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Sales\\Invoices';

    /**
     * Example: table name of Invoices
     *
     * @var string
     */
    public const TABLE = 'Invoices_TABLE';

    /**
     * Example: default items per page for Invoices listings
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

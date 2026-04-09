<?php

namespace App\Constants\HR;

/**
 * Class PayrollConstant
 *
 * Central constants for Payroll HR.
 * Can be used for configuration, table names, or CRUD references.
 */
class PayrollConstant
{
    /**
     * Example: reference to Payroll model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\HR\\Payroll';

    /**
     * Example: table name of Payroll
     *
     * @var string
     */
    public const TABLE = 'Payroll_TABLE';

    /**
     * Example: default items per page for Payroll listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const STATUS_PAID = 1;

    public const STATUS_PENDING = 2;

    public const STATUS_FAILED = 3;

    public function getStatuses(): array
    {
        return [
            self::STATUS_PAID => 'Paid',
            self::STATUS_PENDING => 'Pending',
            self::STATUS_FAILED => 'Failed',
        ];
    }
}

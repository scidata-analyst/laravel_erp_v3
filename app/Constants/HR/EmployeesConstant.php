<?php

namespace App\Constants\HR;

/**
 * Class EmployeesConstant
 *
 * Central constants for Employees HR.
 * Can be used for configuration, table names, or CRUD references.
 */
class EmployeesConstant
{
    /**
     * Example: reference to Employees model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\HR\\Employees';

    /**
     * Example: table name of Employees
     *
     * @var string
     */
    public const TABLE = 'Employees_TABLE';

    /**
     * Example: default items per page for Employees listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const STATUS_ACTIVE = 1;

    public const STATUS_ON_LEAVE = 2;

    public const STATUS_INACTIVE = 3;

    public function getStatuses(): array
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_ON_LEAVE => 'On Leave',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }
}

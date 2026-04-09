<?php

namespace App\Constants\Purchase;

/**
 * Class SuppliersConstant
 *
 * Central constants for Suppliers Purchase.
 * Can be used for configuration, table names, or CRUD references.
 */
class SuppliersConstant
{
    public const STATUS_ACTIVE = 1;

    public const STATUS_INACTIVE = 2;

    public function getStatuses(): array
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }
}

<?php

namespace App\Constants\Accounting;

/**
 * Class TaxConstant
 *
 * Central constants for Tax Accounting.
 * Can be used for configuration, table names, or CRUD references.
 */
class TaxConstant
{
    /**
     * Example: reference to Tax model
     *
     * @var string
     */
    public const MODEL = "App\\Models\\Accounting\\Tax";

    /**
     * Example: table name of Tax
     *
     * @var string
     */
    public const TABLE = "tax";

    /**
     * Example: default items per page for Tax listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for Tax Accounting.
     */

    public const APPLICABLE_SALES = 1;
    public const APPLICABLE_PURCHASES = 2;
    public const APPLICABLE_BOTH = 3;

    
    public function getApplicableTypes(): array
    {
        return [
            self::APPLICABLE_SALES => "Sales",
            self::APPLICABLE_PURCHASES => "Purchases",
            self::APPLICABLE_BOTH => "Both",
        ];
    }
}

<?php

namespace App\Constants\Accounting;

/**
 * Class ApArConstant
 *
 * Central constants for ApAr Accounting.
 * Can be used for configuration, table names, or CRUD references.
 */
class ApArConstant
{
    /**
     * Example: reference to ApAr model
     *
     * @var string
     */
    public const MODEL = "App\\Models\\Accounting\\ApAr";

    /**
     * Example: table name of ApAr
     *
     * @var string
     */
    public const TABLE = "ap_ar";

    /**
     * Example: default items per page for ApAr listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for ApAr Accounting.
     */

    public const TYPE_PAYABLE = 1;
    public const TYPE_RECEIVABLE = 2;

    public function getTypes(): array
    {
        return [
            self::TYPE_PAYABLE => "Payable",
            self::TYPE_RECEIVABLE => "Receivable",
        ];
    }
}

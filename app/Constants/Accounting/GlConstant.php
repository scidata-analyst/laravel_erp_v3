<?php

namespace App\Constants\Accounting;

/**
 * Class GlConstant
 *
 * Central constants for Gl Accounting.
 * Can be used for configuration, table names, or CRUD references.
 */
class GlConstant
{
    /**
     * Example: reference to Gl model
     *
     * @var string
     */
    public const MODEL = "App\\Models\\Accounting\\Gl";

    /**
     * Example: table name of Gl
     *
     * @var string
     */
    public const TABLE = "general_ledger";

    /**
     * Example: default items per page for Gl listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for Gl Accounting.
     */

    public const ASSET_TYPE_ASSET = 1;
    public const ASSET_TYPE_LIABILITY = 2;
    public const ASSET_TYPE_EQUITY = 3;
    public const ASSET_TYPE_REVENUE = 4;
    public const ASSET_TYPE_EXPENSE = 5;


    public function getAssetTypes(): array
    {
        return [
            self::ASSET_TYPE_ASSET => "Asset",
            self::ASSET_TYPE_LIABILITY => "Liability",
            self::ASSET_TYPE_EQUITY => "Equity",
            self::ASSET_TYPE_REVENUE => "Revenue",
            self::ASSET_TYPE_EXPENSE => "Expense",
        ];
    }
}

<?php

namespace App\Constants\Purchase;

/**
 * Class GrnConstant
 *
 * Central constants for Grn Purchase.
 * Can be used for configuration, table names, or CRUD references.
 */
class GrnConstant
{
    /**
     * Example: reference to Grn model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Purchase\\Grn';

    /**
     * Example: table name of Grn
     *
     * @var string
     */
    public const TABLE = 'Grn_TABLE';

    /**
     * Example: default items per page for Grn listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const STATUS_DRAFT = 1;

    public const STATUS_RECEIVED = 2;

    public const STATUS_PARTIAL = 3;

    public function getStatuses(): array
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_RECEIVED => 'Received',
            self::STATUS_PARTIAL => 'Partial',
        ];
    }
}

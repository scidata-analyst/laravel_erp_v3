<?php

namespace App\Constants\Production;

/**
 * Class BomConstant
 *
 * Central constants for Bom Production.
 * Can be used for configuration, table names, or CRUD references.
 */
class BomConstant
{
    /**
     * Example: reference to Bom model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Production\\Bom';

    /**
     * Example: table name of Bom
     *
     * @var string
     */
    public const TABLE = 'Bom_TABLE';

    /**
     * Example: default items per page for Bom listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const STATUS_ACTIVE = 1;

    public const STATUS_DRAFT = 2;

    public const STATUS_ARCHIVED = 3;

    public function getStatuses(): array
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_ARCHIVED => 'Archived',
        ];
    }
}

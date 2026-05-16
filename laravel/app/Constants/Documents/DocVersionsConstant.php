<?php

namespace App\Constants\Documents;

/**
 * Class DocVersionsConstant
 *
 * Central constants for DocVersions Documents.
 * Can be used for configuration, table names, or CRUD references.
 */
class DocVersionsConstant
{
    /**
     * Example: reference to DocVersions model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Documents\\DocVersions';

    /**
     * Example: table name of DocVersions
     *
     * @var string
     */
    public const TABLE = 'DocVersions_TABLE';

    /**
     * Example: default items per page for DocVersions listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for DocVersions Documents.
     */
    public const CHANGE_TYPE_MINOR = 1;

    public const CHANGE_TYPE_MAJOR = 2;

    public const CHANGE_TYPE_CORRECTION = 3;

    public const STATUS_ACTIVE = 1;

    public const STATUS_ARCHIVED = 2;

    public function getChangeTypes(): array
    {
        return [
            self::CHANGE_TYPE_MINOR => 'Minor',
            self::CHANGE_TYPE_MAJOR => 'Major',
            self::CHANGE_TYPE_CORRECTION => 'Correction',
        ];
    }

    public function getStatuses(): array
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_ARCHIVED => 'Archived',
        ];
    }
}

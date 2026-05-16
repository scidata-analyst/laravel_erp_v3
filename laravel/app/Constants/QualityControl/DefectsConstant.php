<?php

namespace App\Constants\QualityControl;

/**
 * Class DefectsConstant
 *
 * Central constants for Defects QualityControl.
 * Can be used for configuration, table names, or CRUD references.
 */
class DefectsConstant
{
    /**
     * Example: reference to Defects model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\QualityControl\\Defects';

    /**
     * Example: table name of Defects
     *
     * @var string
     */
    public const TABLE = 'Defects_TABLE';

    /**
     * Example: default items per page for Defects listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for Defects QualityControl.
     */
    public const SEVERITY_LOW = 1;

    public const SEVERITY_MEDIUM = 2;

    public const SEVERITY_HIGH = 3;

    public const SEVERITY_CRITICAL = 4;

    public const STATUS_OPEN = 1;

    public const STATUS_IN_REVIEW = 2;

    public const STATUS_RESOLVED = 3;

    public function getSeverities(): array
    {
        return [
            self::SEVERITY_LOW => 'Low',
            self::SEVERITY_MEDIUM => 'Medium',
            self::SEVERITY_HIGH => 'High',
            self::SEVERITY_CRITICAL => 'Critical',
        ];
    }

    public function getStatuses(): array
    {
        return [
            self::STATUS_OPEN => 'Open',
            self::STATUS_IN_REVIEW => 'In Review',
            self::STATUS_RESOLVED => 'Resolved',
        ];
    }
}

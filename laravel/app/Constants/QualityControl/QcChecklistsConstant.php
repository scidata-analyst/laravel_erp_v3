<?php

namespace App\Constants\QualityControl;

/**
 * Class QcChecklistsConstant
 *
 * Central constants for QcChecklists QualityControl.
 * Can be used for configuration, table names, or CRUD references.
 */
class QcChecklistsConstant
{
    /**
     * Example: reference to QcChecklists model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\QualityControl\\QcChecklists';

    /**
     * Example: table name of QcChecklists
     *
     * @var string
     */
    public const TABLE = 'QcChecklists_TABLE';

    /**
     * Example: default items per page for QcChecklists listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for QcChecklists QualityControl.
     */
    public const TYPE_INCOMING = 1;

    public const TYPE_IN_PROCESS = 2;

    public const TYPE_FINAL = 3;

    public const STATUS_PASSED = 1;

    public const STATUS_FAILED = 2;

    public function getInspectionTypes(): array
    {
        return [
            self::TYPE_INCOMING => 'Incoming',
            self::TYPE_IN_PROCESS => 'In-Process',
            self::TYPE_FINAL => 'Final',
        ];
    }

    public function getStatuses(): array
    {
        return [
            self::STATUS_PASSED => 'Passed',
            self::STATUS_FAILED => 'Failed',
        ];
    }
}

<?php

namespace App\Constants\QualityControl;

/**
 * Class ComplianceConstant
 *
 * Central constants for Compliance QualityControl.
 * Can be used for configuration, table names, or CRUD references.
 */
class ComplianceConstant
{
    /**
     * Example: reference to Compliance model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\QualityControl\\Compliance';

    /**
     * Example: table name of Compliance
     *
     * @var string
     */
    public const TABLE = 'Compliance_TABLE';

    /**
     * Example: default items per page for Compliance listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for Compliance QualityControl.
     */
    public const STATUS_COMPLIANT = 1;

    public const STATUS_NON_COMPLIANT = 2;

    public const STATUS_PENDING = 3;

    public const STATUS_FAILED = 4;

    public function getStatuses(): array
    {
        return [
            self::STATUS_COMPLIANT => 'Compliant',
            self::STATUS_NON_COMPLIANT => 'Non-Compliant',
            self::STATUS_PENDING => 'Pending',
            self::STATUS_FAILED => 'Failed',
        ];
    }
}

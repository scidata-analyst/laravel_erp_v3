<?php

namespace App\Constants\CRM;

/**
 * Class SupportConstant
 *
 * Central constants for Support CRM.
 * Can be used for configuration, table names, or CRUD references.
 */
class SupportConstant
{
    /**
     * Example: reference to Support model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\CRM\\Support';

    /**
     * Example: table name of Support
     *
     * @var string
     */
    public const TABLE = 'Support_TABLE';

    /**
     * Example: default items per page for Support listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const PRIORITY_LOW = 1;

    public const PRIORITY_MEDIUM = 2;

    public const PRIORITY_HIGH = 3;

    public const PRIORITY_URGENT = 4;

    public const STATUS_OPEN = 1;

    public const STATUS_IN_PROGRESS = 2;

    public const STATUS_RESOLVED = 3;

    public const STATUS_CLOSED = 4;

    public const CATEGORY_BILLING = 1;

    public const CATEGORY_DELIVERY = 2;

    public const CATEGORY_QUALITY = 3;

    public const CATEGORY_OTHER = 4;

    public function getPriorities(): array
    {
        return [
            self::PRIORITY_LOW => 'Low',
            self::PRIORITY_MEDIUM => 'Medium',
            self::PRIORITY_HIGH => 'High',
            self::PRIORITY_URGENT => 'Urgent',
        ];
    }

    public function getStatuses(): array
    {
        return [
            self::STATUS_OPEN => 'Open',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_RESOLVED => 'Resolved',
            self::STATUS_CLOSED => 'Closed',
        ];
    }

    public function getCategories(): array
    {
        return [
            self::CATEGORY_BILLING => 'Billing',
            self::CATEGORY_DELIVERY => 'Delivery',
            self::CATEGORY_QUALITY => 'Quality',
            self::CATEGORY_OTHER => 'Other',
        ];
    }
}

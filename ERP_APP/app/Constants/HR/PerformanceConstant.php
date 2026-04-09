<?php

namespace App\Constants\HR;

/**
 * Class PerformanceConstant
 *
 * Central constants for Performance HR.
 * Can be used for configuration, table names, or CRUD references.
 */
class PerformanceConstant
{
    /**
     * Example: reference to Performance model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\HR\\Performance';

    /**
     * Example: table name of Performance
     *
     * @var string
     */
    public const TABLE = 'Performance_TABLE';

    /**
     * Example: default items per page for Performance listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const RATING_EXCELLENT = 1;

    public const RATING_GOOD = 2;

    public const RATING_SATISFACTORY = 3;

    public const RATING_POOR = 4;

    public const STATUS_COMPLETED = 1;

    public const STATUS_IN_REVIEW = 2;

    public function getRatings(): array
    {
        return [
            self::RATING_EXCELLENT => 'Excellent',
            self::RATING_GOOD => 'Good',
            self::RATING_SATISFACTORY => 'Satisfactory',
            self::RATING_POOR => 'Poor',
        ];
    }

    public function getStatuses(): array
    {
        return [
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_IN_REVIEW => 'In Review',
        ];
    }
}

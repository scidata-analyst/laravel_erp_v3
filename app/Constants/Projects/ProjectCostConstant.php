<?php

namespace App\Constants\Projects;

/**
 * Class ProjectCostConstant
 *
 * Central constants for ProjectCost Projects.
 * Can be used for configuration, table names, or CRUD references.
 */
class ProjectCostConstant
{
    /**
     * Example: reference to ProjectCost model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Projects\\ProjectCost';

    /**
     * Example: table name of ProjectCost
     *
     * @var string
     */
    public const TABLE = 'ProjectCost_TABLE';

    /**
     * Example: default items per page for ProjectCost listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for ProjectCost Projects.
     */
    public const CATEGORY_LABOR = 1;

    public const CATEGORY_MATERIAL = 2;

    public const CATEGORY_OVERHEAD = 3;

    public const CATEGORY_SOFTWARE_LICENSE = 4;

    public const STATUS_ON_BUDGET = 1;

    public const STATUS_OVER_BUDGET = 2;

    public const STATUS_UNDER_BUDGET = 3;

    public function getCostCategories(): array
    {
        return [
            self::CATEGORY_LABOR => 'Labor',
            self::CATEGORY_MATERIAL => 'Material',
            self::CATEGORY_OVERHEAD => 'Overhead',
            self::CATEGORY_SOFTWARE_LICENSE => 'Software License',
        ];
    }

    public function getBudgetStatuses(): array
    {
        return [
            self::STATUS_ON_BUDGET => 'On Budget',
            self::STATUS_OVER_BUDGET => 'Over Budget',
            self::STATUS_UNDER_BUDGET => 'Under Budget',
        ];
    }
}

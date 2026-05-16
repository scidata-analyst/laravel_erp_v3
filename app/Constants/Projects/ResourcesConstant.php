<?php

namespace App\Constants\Projects;

/**
 * Class ResourcesConstant
 *
 * Central constants for Resources Projects.
 * Can be used for configuration, table names, or CRUD references.
 */
class ResourcesConstant
{
    /**
     * Example: reference to Resources model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Projects\\Resources';

    /**
     * Example: table name of Resources
     *
     * @var string
     */
    public const TABLE = 'Resources_TABLE';

    /**
     * Example: default items per page for Resources listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for Resources Projects.
     */
    public const STATUS_ACTIVE = 1;

    public const STATUS_INACTIVE = 2;

    public function getStatuses(): array
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }
}

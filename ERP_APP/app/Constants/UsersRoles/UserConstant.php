<?php

namespace App\Constants\UsersRoles;

/**
 * Class UserConstant
 *
 * Central constants for User UsersRoles.
 * Can be used for configuration, table names, or CRUD references.
 */
class UserConstant
{
    /**
     * Example: reference to User model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\UsersRoles\\User';

    /**
     * Example: table name of User
     *
     * @var string
     */
    public const TABLE = 'User_TABLE';

    /**
     * Example: default items per page for User listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

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

<?php

namespace App\Constants\UsersRoles;

/**
 * Class RolesConstant
 *
 * Central constants for Roles UsersRoles.
 * Can be used for configuration, table names, or CRUD references.
 */
class RolesConstant
{
    /**
     * Example: reference to Roles model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\UsersRoles\\Roles';

    /**
     * Example: table name of Roles
     *
     * @var string
     */
    public const TABLE = 'Roles_TABLE';

    /**
     * Example: default items per page for Roles listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for Roles UsersRoles.
     */
    public const STATUS_ACTIVE = 1;

    public const STATUS_INACTIVE = 2;

    public const PERMISSION_READ = 1;

    public const PERMISSION_CREATE = 2;

    public const PERMISSION_UPDATE = 3;

    public const PERMISSION_DELETE = 4;

    public function getStatuses(): array
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }

    public function getPermissions(): array
    {
        return [
            self::PERMISSION_READ => 'Read',
            self::PERMISSION_CREATE => 'Create',
            self::PERMISSION_UPDATE => 'Update',
            self::PERMISSION_DELETE => 'Delete',
        ];
    }
}

<?php

namespace App\Constants\Projects;

/**
 * Class TasksConstant
 *
 * Central constants for Tasks Projects.
 * Can be used for configuration, table names, or CRUD references.
 */
class TasksConstant
{
    /**
     * Example: reference to Tasks model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Projects\\Tasks';

    /**
     * Example: table name of Tasks
     *
     * @var string
     */
    public const TABLE = 'Tasks_TABLE';

    /**
     * Example: default items per page for Tasks listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const PRIORITY_HIGH = 1;

    public const PRIORITY_MEDIUM = 2;

    public const PRIORITY_LOW = 3;

    public const STATUS_TODO = 1;

    public const STATUS_IN_PROGRESS = 2;

    public const STATUS_REVIEW = 3;

    public const STATUS_DONE = 4;

    public function getPriorities(): array
    {
        return [
            self::PRIORITY_HIGH => 'High',
            self::PRIORITY_MEDIUM => 'Medium',
            self::PRIORITY_LOW => 'Low',
        ];
    }

    public function getStatuses(): array
    {
        return [
            self::STATUS_TODO => 'Todo',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_REVIEW => 'Review',
            self::STATUS_DONE => 'Done',
        ];
    }
}

<?php

namespace App\Constants\CRM;

/**
 * Class InteractionsConstant
 *
 * Central constants for Interactions CRM.
 * Can be used for configuration, table names, or CRUD references.
 */
class InteractionsConstant
{
    /**
     * Example: reference to Interactions model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\CRM\\Interactions';

    /**
     * Example: table name of Interactions
     *
     * @var string
     */
    public const TABLE = 'Interactions_TABLE';

    /**
     * Example: default items per page for Interactions listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const TYPE_CALL = 1;

    public const TYPE_EMAIL = 2;

    public const TYPE_MEETING = 3;

    public const TYPE_NOTE = 4;

    public function getTypes(): array
    {
        return [
            self::TYPE_CALL => 'Call',
            self::TYPE_EMAIL => 'Email',
            self::TYPE_MEETING => 'Meeting',
            self::TYPE_NOTE => 'Note',
        ];
    }
}

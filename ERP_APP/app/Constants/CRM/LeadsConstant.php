<?php

namespace App\Constants\CRM;

/**
 * Class LeadsConstant
 *
 * Central constants for Leads CRM.
 * Can be used for configuration, table names, or CRUD references.
 */
class LeadsConstant
{
    /**
     * Example: reference to Leads model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\CRM\\Leads';

    /**
     * Example: table name of Leads
     *
     * @var string
     */
    public const TABLE = 'Leads_TABLE';

    /**
     * Example: default items per page for Leads listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    public const STAGE_NEW = 1;

    public const STAGE_QUALIFIED = 2;

    public const STAGE_PROPOSAL = 3;

    public const STAGE_WON = 4;

    public const STAGE_LOST = 5;

    public function getStages(): array
    {
        return [
            self::STAGE_NEW => 'New',
            self::STAGE_QUALIFIED => 'Qualified',
            self::STAGE_PROPOSAL => 'Proposal',
            self::STAGE_WON => 'Won',
            self::STAGE_LOST => 'Lost',
        ];
    }
}

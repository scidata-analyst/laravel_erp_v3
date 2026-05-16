<?php

namespace App\Constants\Documents;

/**
 * Class DocLibraryConstant
 *
 * Central constants for DocLibrary Documents.
 * Can be used for configuration, table names, or CRUD references.
 */
class DocLibraryConstant
{
    /**
     * Example: reference to DocLibrary model
     *
     * @var string
     */
    public const MODEL = 'App\\Models\\Documents\\DocLibrary';

    /**
     * Example: table name of DocLibrary
     *
     * @var string
     */
    public const TABLE = 'DocLibrary_TABLE';

    /**
     * Example: default items per page for DocLibrary listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for DocLibrary Documents.
     */
    public const TYPE_CONTRACT = 1;

    public const TYPE_INVOICE = 2;

    public const TYPE_PURCHASE_ORDER = 3;

    public const TYPE_REPORT = 4;

    public const TYPE_CERTIFICATE = 5;

    public const ACCESS_PUBLIC = 1;

    public const ACCESS_PRIVATE = 2;

    public const ACCESS_RESTRICTED = 3;

    public function getDocumentTypes(): array
    {
        return [
            self::TYPE_CONTRACT => 'Contract',
            self::TYPE_INVOICE => 'Invoice',
            self::TYPE_PURCHASE_ORDER => 'Purchase Order',
            self::TYPE_REPORT => 'Report',
            self::TYPE_CERTIFICATE => 'Certificate',
        ];
    }

    public function getAccessLevels(): array
    {
        return [
            self::ACCESS_PUBLIC => 'Public',
            self::ACCESS_PRIVATE => 'Private',
            self::ACCESS_RESTRICTED => 'Restricted',
        ];
    }
}

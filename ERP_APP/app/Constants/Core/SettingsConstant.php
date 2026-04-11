<?php

namespace App\Constants\Core;

/**
 * Class SettingsConstant
 *
 * Central constants for Settings Core.
 * Can be used for configuration, table names, or CRUD references.
 */
class SettingsConstant
{
    /**
     * Example: reference to Settings model
     *
     * @var string
     */
    public const MODEL = "App\\Models\\Core\\Settings";

    /**
     * Example: table name of Settings
     *
     * @var string
     */
    public const TABLE = "Settings_TABLE";

    /**
     * Example: default items per page for Settings listings
     *
     * @var int
     */
    public const PER_PAGE = 15;

    /**
     * Additional constants for Settings Core.
     */

    public const BASE_CURRENCY_USD = 1;
    public const BASE_CURRENCY_EUR = 2;
    public const BASE_CURRENCY_BDT = 3;

    public const EMAIL_NOTIFICATION_ENABLED = 1;
    public const EMAIL_NOTIFICATION_DISABLED = 2;

    public const TWO_FACTOR_AUTH_ENABLED = 1;
    public const TWO_FACTOR_AUTH_DISABLED = 2;

    public const PASSWORD_POLICY_STRONG = 1;
    public const PASSWORD_POLICY_MEDIUM = 2;
    public const PASSWORD_POLICY_NORMAL = 3;

    public const DEFAULT_VALUATION_FIFO = 1;
    public const DEFAULT_VALUATION_LIFO = 2;
    public const DEFAULT_VALUATION_AVERAGE = 3;

    public const AUTO_REPORT_ENABLED = 1;
    public const AUTO_REPORT_DISABLED = 2;


    public function getCurrencies() : array
    {
        return [
            self::BASE_CURRENCY_USD => "USD",
            self::BASE_CURRENCY_EUR => "EUR",
            self::BASE_CURRENCY_BDT => "BDT",
        ];
    }

    public function getCurrencySymbols() : array
    {
        return [
            self::BASE_CURRENCY_USD => "$",
            self::BASE_CURRENCY_EUR => "€",
            self::BASE_CURRENCY_BDT => "৳",
        ];
    }

    public function getNotificationStatuses() : array
    {
        return [
            self::EMAIL_NOTIFICATION_ENABLED => "Enabled",
            self::EMAIL_NOTIFICATION_DISABLED => "Disabled",
        ];
    }

    public function getTwoFactorAuthStatuses() : array
    {
        return [
            self::TWO_FACTOR_AUTH_ENABLED => "Enabled",
            self::TWO_FACTOR_AUTH_DISABLED => "Disabled",
        ];
    }

    public function getPasswordPolicyStatuses() : array
    {
        return [
            self::PASSWORD_POLICY_STRONG => "Strong (Minimum 8 characters, special characters, numbers)",
            self::PASSWORD_POLICY_MEDIUM => "Medium (Minimum 6 characters)",
            self::PASSWORD_POLICY_NORMAL => "Normal (Minimum 4 characters)",
        ];
    }

    public function getValuationMethods() : array
    {
        return [
            self::DEFAULT_VALUATION_FIFO => "FIFO",
            self::DEFAULT_VALUATION_LIFO => "LIFO",
            self::DEFAULT_VALUATION_AVERAGE => "Average",
        ];
    }

    public function getAutoReportStatuses() : array
    {
        return [
            self::AUTO_REPORT_ENABLED => "Enabled",
            self::AUTO_REPORT_DISABLED => "Disabled",
        ];
    }
}

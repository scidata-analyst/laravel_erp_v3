<?php

namespace App\DTOs\Core;

use App\DTOs\Logistics\WarehousesDTO;
use App\Models\Core\Settings;

/**
 * Data Transfer Object for Settings entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates system configuration/settings data.
 *
 * @property int|null $id
 * @property string|null $companyName
 * @property string|null $companyEmail
 * @property string|null $phoneNumber
 * @property string|null $address
 * @property string|null $country
 * @property int|null $sessionTimeoutMinutes
 * @property bool|null $twoFactorAuthEnabled
 * @property string|null $passwordPolicy
 * @property string|null $ipWhitelist
 * @property bool|null $emailNotificationsEnabled
 * @property int|null $lowStockThreshold
 * @property string|null $alertRecipients
 * @property string|null $defaultValuationMethod
 * @property bool|null $autoReorderEnabled
 * @property int|null $defaultWarehouseId
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property WarehousesDTO|null $defaultWarehouse
 */
class SettingsDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Company name */
    public ?string $companyName;

    /** @var string|null Company email address */
    public ?string $companyEmail;

    /** @var string|null Company phone number */
    public ?string $phoneNumber;

    /** @var string|null Company address */
    public ?string $address;

    /** @var string|null Country */
    public ?string $country;

    /** @var int|null Session timeout in minutes */
    public ?int $sessionTimeoutMinutes;

    /** @var bool|null Whether two-factor authentication is enabled */
    public ?bool $twoFactorAuthEnabled;

    /** @var string|null Password policy rules */
    public ?string $passwordPolicy;

    /** @var string|null Comma-separated IP whitelist */
    public ?string $ipWhitelist;

    /** @var bool|null Whether email notifications are enabled */
    public ?bool $emailNotificationsEnabled;

    /** @var int|null Low stock alert threshold quantity */
    public ?int $lowStockThreshold;

    /** @var string|null Comma-separated list of alert recipients */
    public ?string $alertRecipients;

    /** @var string|null Default inventory valuation method (e.g., 'FIFO', 'LIFO') */
    public ?string $defaultValuationMethod;

    /** @var bool|null Whether automatic reorder is enabled */
    public ?bool $autoReorderEnabled;

    /** @var int|null Foreign key to warehouses table (default warehouse) */
    public ?int $defaultWarehouseId;

    /** @var int|null Status: 0=Inactive, 1=Active */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var WarehousesDTO|null Related default warehouse */
    public ?WarehousesDTO $defaultWarehouse;

    /**
     * Create a new SettingsDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->companyName = $data['company_name'] ?? null;
        $this->companyEmail = $data['company_email'] ?? null;
        $this->phoneNumber = $data['phone_number'] ?? null;
        $this->address = $data['address'] ?? null;
        $this->country = $data['country'] ?? null;
        $this->sessionTimeoutMinutes = isset($data['session_timeout_minutes']) ? (int) $data['session_timeout_minutes'] : null;
        $this->twoFactorAuthEnabled = isset($data['two_factor_auth_enabled']) ? (bool) $data['two_factor_auth_enabled'] : null;
        $this->passwordPolicy = $data['password_policy'] ?? null;
        $this->ipWhitelist = $data['ip_whitelist'] ?? null;
        $this->emailNotificationsEnabled = isset($data['email_notifications_enabled']) ? (bool) $data['email_notifications_enabled'] : null;
        $this->lowStockThreshold = isset($data['low_stock_threshold']) ? (int) $data['low_stock_threshold'] : null;
        $this->alertRecipients = $data['alert_recipients'] ?? null;
        $this->defaultValuationMethod = $data['default_valuation_method'] ?? null;
        $this->autoReorderEnabled = isset($data['auto_reorder_enabled']) ? (bool) $data['auto_reorder_enabled'] : null;
        $this->defaultWarehouseId = isset($data['default_warehouse_id']) ? (int) $data['default_warehouse_id'] : null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->defaultWarehouse = $data['defaultWarehouse'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Settings $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(Settings $model): self
    {
        $data = [
            'id' => $model->id,
            'company_name' => $model->company_name,
            'company_email' => $model->company_email,
            'phone_number' => $model->phone_number,
            'address' => $model->address,
            'country' => $model->country,
            'session_timeout_minutes' => $model->session_timeout_minutes,
            'two_factor_auth_enabled' => $model->two_factor_auth_enabled,
            'password_policy' => $model->password_policy,
            'ip_whitelist' => $model->ip_whitelist,
            'email_notifications_enabled' => $model->email_notifications_enabled,
            'low_stock_threshold' => $model->low_stock_threshold,
            'alert_recipients' => $model->alert_recipients,
            'default_valuation_method' => $model->default_valuation_method,
            'auto_reorder_enabled' => $model->auto_reorder_enabled,
            'default_warehouse_id' => $model->default_warehouse_id,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('default_warehouse')) {
            $data['defaultWarehouse'] = WarehousesDTO::fromModel($model->default_warehouse);
        }

        return new self($data);
    }

    /**
     * Create DTO from plain array data.
     *
     * @param array $data Associative array with DTO properties
     * @return self New DTO instance
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Convert DTO to array representation.
     *
     * @return array Array with snake_case keys matching database columns
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'company_name' => $this->companyName,
            'company_email' => $this->companyEmail,
            'phone_number' => $this->phoneNumber,
            'address' => $this->address,
            'country' => $this->country,
            'session_timeout_minutes' => $this->sessionTimeoutMinutes,
            'two_factor_auth_enabled' => $this->twoFactorAuthEnabled,
            'password_policy' => $this->passwordPolicy,
            'ip_whitelist' => $this->ipWhitelist,
            'email_notifications_enabled' => $this->emailNotificationsEnabled,
            'low_stock_threshold' => $this->lowStockThreshold,
            'alert_recipients' => $this->alertRecipients,
            'default_valuation_method' => $this->defaultValuationMethod,
            'auto_reorder_enabled' => $this->autoReorderEnabled,
            'default_warehouse_id' => $this->defaultWarehouseId,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    /**
     * Convert DTO to array for Eloquent model creation/update.
     *
     * Returns fillable attributes only, excluding timestamps
     * and foreign keys for related models.
     *
     * @return array Associative array for model mass assignment
     */
    public function toModel(): array
    {
        return [
            'company_name' => $this->companyName,
            'company_email' => $this->companyEmail,
            'phone_number' => $this->phoneNumber,
            'address' => $this->address,
            'country' => $this->country,
            'session_timeout_minutes' => $this->sessionTimeoutMinutes,
            'two_factor_auth_enabled' => $this->twoFactorAuthEnabled,
            'password_policy' => $this->passwordPolicy,
            'ip_whitelist' => $this->ipWhitelist,
            'email_notifications_enabled' => $this->emailNotificationsEnabled,
            'low_stock_threshold' => $this->lowStockThreshold,
            'alert_recipients' => $this->alertRecipients,
            'default_valuation_method' => $this->defaultValuationMethod,
            'auto_reorder_enabled' => $this->autoReorderEnabled,
            'default_warehouse_id' => $this->defaultWarehouseId,
            'status' => $this->status,
        ];
    }
}

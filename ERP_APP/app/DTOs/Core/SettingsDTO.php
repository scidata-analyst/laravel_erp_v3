<?php

namespace App\DTOs\Core;

use App\DTOs\Logistics\WarehousesDTO;
use App\Models\Core\Settings;

class SettingsDTO
{
    public ?int $id;

    public ?string $companyName;

    public ?string $companyEmail;

    public ?string $phoneNumber;

    public ?string $address;

    public ?string $country;

    public ?int $sessionTimeoutMinutes;

    public ?bool $twoFactorAuthEnabled;

    public ?string $passwordPolicy;

    public ?string $ipWhitelist;

    public ?bool $emailNotificationsEnabled;

    public ?int $lowStockThreshold;

    public ?string $alertRecipients;

    public ?string $defaultValuationMethod;

    public ?bool $autoReorderEnabled;

    public ?int $defaultWarehouseId;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?WarehousesDTO $defaultWarehouse;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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

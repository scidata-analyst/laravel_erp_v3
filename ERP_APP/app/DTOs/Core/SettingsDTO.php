<?php

namespace App\DTOs\Core;

final class SettingsDTO
{
    public readonly string $settingKey;
    public readonly mixed $settingValue;
    public readonly ?string $settingType;
    public readonly ?string $category;
    public readonly ?string $description;
    public readonly bool $isSystem;
    public readonly ?int $updatedBy;
    public readonly ?array $validationRules;

    public function __construct(array $data)
    {
        $this->settingKey = (string)($data['setting_key'] ?? $data['key'] ?? '');
        $this->settingValue = $data['setting_value'] ?? $data['value'] ?? null;
        $this->settingType = (string)($data['setting_type'] ?? 'string');
        $this->category = (string)($data['category'] ?? 'General');
        $this->description = $data['description'] ?? null;
        $this->isSystem = isset($data['is_system']) ? (bool)$data['is_system'] : false;
        $this->updatedBy = isset($data['updated_by']) ? (int)$data['updated_by'] : null;
        $this->validationRules = $data['validation_rules'] ?? null;
    }
}
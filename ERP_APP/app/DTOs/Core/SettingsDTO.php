<?php

namespace App\DTOs\Core;

class SettingsDTO
{
    public function __construct(
        public readonly string $setting_key,
        public readonly mixed $setting_value,
        public readonly ?string $setting_type = 'string',
        public readonly ?string $category = 'General',
        public readonly ?string $description = null,
        public readonly bool $is_system = false,
        public readonly ?int $updated_by = null,
        public readonly ?array $validation_rules = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            setting_key: $data['setting_key'] ?? $data['key'],
            setting_value: $data['setting_value'] ?? $data['value'],
            setting_type: $data['setting_type'] ?? 'string',
            category: $data['category'] ?? 'General',
            description: $data['description'] ?? null,
            is_system: (bool) ($data['is_system'] ?? false),
            updated_by: isset($data['updated_by']) ? (int) $data['updated_by'] : null,
            validation_rules: $data['validation_rules'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'setting_key' => $this->setting_key,
            'key' => $this->setting_key,
            'setting_value' => $this->setting_value,
            'value' => $this->setting_value,
            'setting_type' => $this->setting_type,
            'category' => $this->category,
            'description' => $this->description,
            'is_system' => $this->is_system,
            'updated_by' => $this->updated_by,
            'validation_rules' => $this->validation_rules,
        ];
    }
}

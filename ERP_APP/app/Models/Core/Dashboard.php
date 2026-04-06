<?php

namespace App\DTOs\Core;

final class DashboardDTO
{
    public readonly ?array $widgetConfig;
    public readonly ?array $layoutPreferences;
    public readonly ?string $theme;
    public readonly ?string $language;
    public readonly ?string $timezone;
    public readonly ?string $defaultDateRange;
    public readonly ?int $refreshInterval;
    public readonly ?int $userId;
    public readonly ?bool $isDefault;
    public readonly ?string $dashboardType;

    public function __construct(array $data)
    {
        $this->widgetConfig = $data['widget_config'] ?? null;
        $this->layoutPreferences = $data['layout_preferences'] ?? null;
        $this->theme = $data['theme'] ?? null;
        $this->language = $data['language'] ?? null;
        $this->timezone = $data['timezone'] ?? null;
        $this->defaultDateRange = $data['default_date_range'] ?? null;
        $this->refreshInterval = isset($data['refresh_interval']) ? (int)$data['refresh_interval'] : null;
        $this->userId = isset($data['user_id']) ? (int)$data['user_id'] : null;
        $this->isDefault = isset($data['is_default']) ? (bool)$data['is_default'] : null;
        $this->dashboardType = $data['dashboard_type'] ?? null;
    }
}
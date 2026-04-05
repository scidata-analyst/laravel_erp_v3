<?php

namespace App\Http\Resources\Core;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'setting_key' => $this->setting_key,
            'key' => $this->setting_key,
            'setting_value' => $this->setting_value,
            'value' => $this->setting_value,
            'setting_type' => $this->setting_type,
            'category' => $this->category,
            'description' => $this->description,
            'is_system' => $this->is_system,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}

<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Inventory Sync record.
 */
class InvSyncUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'channel_id' => ['sometimes', 'integer', 'exists:online_channels,id'],
            'last_sync_time' => ['sometimes', 'date'],
            'total_synced_items' => ['sometimes', 'integer', 'min:0'],
            'sync_errors' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'channel_id.exists' => 'The selected channel is invalid.',
            'total_synced_items.integer' => 'Total synced items must be an integer.',
        ];
    }
}
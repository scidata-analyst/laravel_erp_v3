<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Inventory Sync record.
 */
class InvSyncStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'channel_id' => ['required', 'integer', 'exists:online_channels,id'],
            'last_sync_time' => ['required', 'date'],
            'total_synced_items' => ['required', 'integer', 'min:0'],
            'sync_errors' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'channel_id.required' => 'The channel is required.',
            'channel_id.exists' => 'The selected channel is invalid.',
            'last_sync_time.required' => 'The last sync time is required.',
            'total_synced_items.required' => 'The total synced items is required.',
            'total_synced_items.integer' => 'Total synced items must be an integer.',
        ];
    }
}
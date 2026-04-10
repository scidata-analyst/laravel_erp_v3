<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Inventory Sync data.
 *
 * Validates fields based on the InvSync model fillable attributes:
 * - channel_id: required, exists in online_channels table (foreign key relationship)
 * - last_sync_time: nullable, datetime
 * - total_synced_items: nullable, integer, min 0
 * - sync_errors: nullable, string, max 500
 * - status: nullable, string, max 50
 */
class InvSyncRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get the sync ID for unique validation on updates
        $syncId = $this->route('inv_sync');

        return [
            // Channel: required, must exist in online_channels table
            'channel_id' => ['required', 'exists:App\Models\Ecommerce\OnlineChannels,id'],

            // Last sync time: optional, must be a valid datetime
            'last_sync_time' => ['nullable', 'date'],

            // Total synced items: optional, integer, must be 0 or greater
            'total_synced_items' => ['nullable', 'integer', 'min:0'],

            // Sync errors: optional, string, max 500 characters
            'sync_errors' => ['nullable', 'string', 'max:500'],

            // Status: optional, string, max 50 characters (e.g., success, failed, in_progress)
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'channel_id.required' => 'Please select an online channel.',
            'channel_id.exists' => 'The selected channel does not exist.',
            'last_sync_time.date' => 'Please enter a valid datetime.',
            'total_synced_items.integer' => 'Total synced items must be an integer.',
            'total_synced_items.min' => 'Total synced items must be at least 0.',
            'sync_errors.max' => 'Sync errors must not exceed 500 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}

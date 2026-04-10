<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Online Channel data.
 *
 * Validates fields based on the OnlineChannels model fillable attributes:
 * - channel_name: required, string, max 100
 * - platform: required, string, max 50
 * - api_store_url: nullable, url, max 255
 * - api_key: nullable, string, max 255
 * - sync_frequency: nullable, string, max 50
 * - status: nullable, string, max 50
 */
class OnlineChannelsRequest extends FormRequest
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
        // Get the channel ID for unique validation on updates
        $channelId = $this->route('online_channel');

        return [
            // Channel name: required, string, max 100 characters
            'channel_name' => ['required', 'string', 'max:100'],

            // Platform: required, string, max 50 characters (e.g., shopify, amazon, magento)
            'platform' => ['required', 'string', 'max:50'],

            // API store URL: optional, valid URL format, max 255 characters
            'api_store_url' => ['nullable', 'url', 'max:255'],

            // API key: optional, string, max 255 characters (should be encrypted in production)
            'api_key' => ['nullable', 'string', 'max:255'],

            // Sync frequency: optional, string, max 50 characters (e.g., hourly, daily)
            'sync_frequency' => ['nullable', 'string', 'max:50'],

            // Status: optional, string, max 50 characters (e.g., active, inactive)
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
            'channel_name.required' => 'The channel name is required.',
            'channel_name.max' => 'Channel name must not exceed 100 characters.',
            'platform.required' => 'The platform is required.',
            'platform.max' => 'Platform must not exceed 50 characters.',
            'api_store_url.url' => 'Please enter a valid URL.',
            'api_store_url.max' => 'API store URL must not exceed 255 characters.',
            'api_key.max' => 'API key must not exceed 255 characters.',
            'sync_frequency.max' => 'Sync frequency must not exceed 50 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}

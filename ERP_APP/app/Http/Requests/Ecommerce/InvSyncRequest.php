<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class InvSyncRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('get')) {
            return [
                'per_page' => 'nullable|integer|min:1|max:100',
                'sync_status' => 'nullable|string|in:Synced,Pending,Failed',
                'channel' => 'nullable|string|in:Shopify,Amazon,WooCommerce,Magento',
                'search' => 'nullable|string'
            ];
        }

        return [
            'terminal_id' => 'nullable|integer',
            'channel_id' => 'required|integer',
            'sync_type' => 'required|string|max:100',
            'product_sku' => 'nullable|string|max:255',
            'product_id' => 'nullable',
            'online_quantity' => 'nullable|numeric',
            'local_quantity' => 'nullable|numeric',
            'records_synced' => 'nullable|integer|min:0',
            'started_at' => 'nullable|date',
            'completed_at' => 'nullable|date',
            'sync_date' => 'nullable|date',
            'status' => 'nullable|string|max:100',
        ];
    }
}

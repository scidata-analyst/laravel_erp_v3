<?php

namespace App\Http\Requests\Sales;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Promotion.
 */
class PromotionsUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $promoId = $this->route('promotion');
        return [
            'promo_code' => ['sometimes', 'string', 'max:50', 'unique:promotions,promo_code,' . $promoId],
            'description' => ['sometimes', 'string', 'max:255'],
            'discount_value' => ['sometimes', 'numeric', 'min:0'],
            'discount_type' => ['sometimes', 'string', 'max:20'],
            'minimum_order_amount' => ['nullable', 'numeric', 'min:0'],
            'valid_from' => ['sometimes', 'date'],
            'valid_to' => ['sometimes', 'date'],
            'applicable_products' => ['nullable', 'string', 'max:500'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'promo_code.unique' => 'The promo code must be unique.',
            'valid_to.after' => 'Valid to date must be after valid from date.',
        ];
    }
}
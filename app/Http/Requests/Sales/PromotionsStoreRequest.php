<?php

namespace App\Http\Requests\Sales;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Promotion.
 */
class PromotionsStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'promo_code' => ['required', 'string', 'max:50', 'unique:promotions,promo_code'],
            'description' => ['required', 'string', 'max:255'],
            'discount_value' => ['required', 'numeric', 'min:0'],
            'discount_type' => ['required', 'string', 'max:20'],
            'minimum_order_amount' => ['nullable', 'numeric', 'min:0'],
            'valid_from' => ['required', 'date'],
            'valid_to' => ['required', 'date', 'after:valid_from'],
            'applicable_products' => ['nullable', 'string', 'max:500'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'promo_code.required' => 'The promo code is required.',
            'promo_code.unique' => 'The promo code must be unique.',
            'description.required' => 'The description is required.',
            'discount_value.required' => 'The discount value is required.',
            'discount_type.required' => 'The discount type is required.',
            'valid_from.required' => 'The valid from date is required.',
            'valid_to.required' => 'The valid to date is required.',
            'valid_to.after' => 'Valid to date must be after valid from date.',
        ];
    }
}
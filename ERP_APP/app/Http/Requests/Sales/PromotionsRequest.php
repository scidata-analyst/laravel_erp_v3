<?php

namespace App\Http\Requests\Sales;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Promotion data.
 *
 * Validates fields based on the Promotions model fillable attributes:
 * - promo_code: required, string, unique in promotions table
 * - description: nullable, string, max 500
 * - discount_value: required, numeric, min 0
 * - discount_type: required, string, in:percentage,fixed
 * - minimum_order_amount: nullable, numeric, min 0
 * - valid_from: required, date
 * - valid_to: required, date, must be after valid_from
 * - applicable_products: nullable, string, max 500
 * - status: nullable, string, max 50
 */
class PromotionsRequest extends FormRequest
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
        // Get the promotion ID for unique validation on updates
        $promoId = $this->route('promotion');

        return [
            // Promo code: required, string, max 50 characters, unique in promotions
            'promo_code' => [
                'required',
                'string',
                'max:50',
                "unique:promotions,promo_code,{$promoId},id",
            ],

            // Description: optional, string, max 500 characters
            'description' => ['nullable', 'string', 'max:500'],

            // Discount value: required, numeric, must be 0 or greater
            'discount_value' => ['required', 'numeric', 'min:0'],

            // Discount type: required, must be either percentage or fixed
            'discount_type' => ['required', 'string', 'in:percentage,fixed'],

            // Minimum order amount: optional, numeric, must be 0 or greater
            'minimum_order_amount' => ['nullable', 'numeric', 'min:0'],

            // Valid from: required, must be a valid date
            'valid_from' => ['required', 'date'],

            // Valid to: required, must be a valid date after valid_from
            'valid_to' => ['required', 'date', 'after:valid_from'],

            // Applicable products: optional, string, max 500 characters
            'applicable_products' => ['nullable', 'string', 'max:500'],

            // Status: optional, string, max 50 characters
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
            'promo_code.required' => 'The promo code is required.',
            'promo_code.max' => 'The promo code must not exceed 50 characters.',
            'promo_code.unique' => 'This promo code is already in use.',
            'description.max' => 'Description must not exceed 500 characters.',
            'discount_value.required' => 'The discount value is required.',
            'discount_value.numeric' => 'Discount value must be a numeric value.',
            'discount_value.min' => 'Discount value must be at least 0.',
            'discount_type.required' => 'The discount type is required.',
            'discount_type.in' => 'Discount type must be either percentage or fixed.',
            'minimum_order_amount.numeric' => 'Minimum order amount must be a numeric value.',
            'minimum_order_amount.min' => 'Minimum order amount must be at least 0.',
            'valid_from.required' => 'The valid from date is required.',
            'valid_from.date' => 'Please enter a valid date.',
            'valid_to.required' => 'The valid to date is required.',
            'valid_to.date' => 'Please enter a valid date.',
            'valid_to.after' => 'Valid to date must be after the valid from date.',
            'applicable_products.max' => 'Applicable products must not exceed 500 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}

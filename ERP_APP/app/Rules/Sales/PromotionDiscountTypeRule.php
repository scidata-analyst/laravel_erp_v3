<?php

namespace App\Rules\Sales;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PromotionDiscountTypeRule implements ValidationRule
{
    protected array $allowedTypes = ['Percentage', 'Fixed Amount'];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, $this->allowedTypes)) {
            $fail('The :attribute must be one of: ' . implode(', ', $this->allowedTypes));
        }
    }
}

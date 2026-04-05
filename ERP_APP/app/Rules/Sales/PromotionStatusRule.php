<?php

namespace App\Rules\Sales;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PromotionStatusRule implements ValidationRule
{
    protected array $allowedStatuses = ['active', 'inactive', 'expired'];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array(strtolower($value), $this->allowedStatuses)) {
            $fail('The :attribute must be one of: ' . implode(', ', $this->allowedStatuses));
        }
    }
}

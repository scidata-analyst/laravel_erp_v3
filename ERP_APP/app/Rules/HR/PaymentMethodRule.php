<?php

namespace App\Rules\HR;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PaymentMethodRule implements ValidationRule
{
    protected array $allowedMethods = ['Bank Transfer', 'Cash', 'Check'];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, $this->allowedMethods)) {
            $fail('The :attribute must be one of: ' . implode(', ', $this->allowedMethods));
        }
    }
}

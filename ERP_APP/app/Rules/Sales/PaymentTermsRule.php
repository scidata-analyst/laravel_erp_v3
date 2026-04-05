<?php

namespace App\Rules\Sales;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PaymentTermsRule implements ValidationRule
{
    protected array $allowedTerms = ['Net 30', 'Due on Receipt'];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, $this->allowedTerms)) {
            $fail('The :attribute must be one of: ' . implode(', ', $this->allowedTerms));
        }
    }
}

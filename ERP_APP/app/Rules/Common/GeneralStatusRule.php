<?php

namespace App\Rules\Common;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class GeneralStatusRule implements ValidationRule
{
    protected array $allowedStatuses = ['Active', 'Inactive'];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, $this->allowedStatuses)) {
            $fail('The :attribute must be one of: ' . implode(', ', $this->allowedStatuses));
        }
    }
}

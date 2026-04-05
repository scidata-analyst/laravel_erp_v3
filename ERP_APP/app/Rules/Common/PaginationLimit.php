<?php

namespace App\Rules\Common;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PaginationLimit implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_numeric($value) || $value < 1 || $value > 100) {
            $fail('The :attribute must be an integer between 1 and 100.');
        }
    }
}

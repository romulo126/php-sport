<?php

namespace App\Rules\Api\Sports\Players;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
}

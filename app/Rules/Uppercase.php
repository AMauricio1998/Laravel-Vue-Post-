<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Uppercase implements Rule
{
    
    public function passes($attribute, $value)
    {
        return strtoupper($value) == $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El texto no esta en mayusculas.';
    }
}

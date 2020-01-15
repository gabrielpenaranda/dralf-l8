<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Menor implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($cprol)
    {
        $this->cprol = $cprol;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ($value < $this->cprol);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La cantidad de prueba debe ser menor a la producida';
    }
}

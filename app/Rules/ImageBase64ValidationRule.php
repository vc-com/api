<?php

namespace VoceCrianca\Rules;

use Illuminate\Contracts\Validation\Rule;

class ImageBase64ValidationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
       return checkIsImageBase64($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'As :attribute enviada não é válida!';
    }
}

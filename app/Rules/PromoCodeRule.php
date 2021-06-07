<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PromoCodeRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^[a-z0-9]{2}-[a-z0-9]{3}-[a-z0-9]{4}-[a-z0-9]{5}-[a-z0-9]{2}$/i', $value);
    }

    public function message()
    {
        return 'The promo code is invalid.';
    }
}

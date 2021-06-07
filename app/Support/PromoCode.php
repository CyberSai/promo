<?php

namespace App\Support;

use Illuminate\Support\Str;

class PromoCode
{
    private function __construct() { }

    public static function generate()
    {
        return implode('-', [
            Str::random(2),
            Str::random(3),
            Str::random(4),
            Str::random(5),
            Str::random(2),
        ]);
    }
}

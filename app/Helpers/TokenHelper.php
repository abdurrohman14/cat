<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class TokenHelper {
    public static function generateToken() {
        return strtoupper(Str::random(8));
    }
}

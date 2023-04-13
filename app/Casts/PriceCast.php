<?php

namespace App\Casts;

use Illuminate\Support\Str;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PriceCast implements CastsAttributes
{
    // Accesser
    public function set($model, string $key, $value, array $attributes){
        return $value * 100;
    }

    // Mutator
    public function get($model, string $key, $value, array $attributes){
        return $value / 100;
    }
}

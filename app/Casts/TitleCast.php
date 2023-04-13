<?php

namespace App\Casts;

use Illuminate\Support\Str;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class TitleCast implements CastsAttributes
{
    // Accesser
    public function set($model, string $key, $value, array $attributes){
        return Str::lower($value);
    }

    // Mutator
    public function get($model, string $key, $value, array $attributes){
        return Str::ucfirst($value);
    }
}

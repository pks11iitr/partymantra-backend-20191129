<?php

namespace App\Models\Traits;

trait Active{
    public static function active(){
        return self::where('isactive', true);
    }
}

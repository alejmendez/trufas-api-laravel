<?php

namespace App\Services\Quarters;

use App\Models\Quarter;

class CreateQuarter
{
    public static function call($data): Quarter
    {
        $quarter = Quarter::create($data);
        return $quarter;
    }
}

<?php

namespace App\Services\Quarters;

use App\Models\Quarter;

class ListQuarter
{
    public static function call($order, $search)
    {
        $quarter = Quarter::with('field')->order($order)->search($search);

        return $quarter;
    }
}

<?php

namespace App\Services\Quarters;

use App\Models\Quarter;

class ListQuarter
{
    public static function call($filters, $order, $search)
    {
        $quarter = Quarter::with('field', 'plant')->filter($filters)->order($order)->search($search);

        return $quarter;
    }
}

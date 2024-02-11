<?php

namespace App\Services\Plants;

use App\Models\Plant;

class ListPlant
{
    public static function call($filters, $order, $search)
    {
        $plants = Plant::with('quarter.field')->filter($filters)->order($order)->search($search);

        return $plants;
    }
}

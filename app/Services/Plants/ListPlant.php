<?php

namespace App\Services\Plants;

use App\Models\Plant;

class ListPlant
{
    public static function call($order, $search)
    {
        $plants = Plant::with('quarter', 'field')->order($order)->search($search);

        return $plants;
    }
}

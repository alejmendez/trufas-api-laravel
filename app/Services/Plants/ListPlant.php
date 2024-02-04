<?php

namespace App\Services\Plants;

use App\Models\Plant;

class ListPlant
{
    public static function call($order, $search)
    {
        $plants = Plant::order($order)->search($search);

        return $plants;
    }
}

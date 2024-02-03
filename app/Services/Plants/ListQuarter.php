<?php

namespace App\Services\Plants;

use App\Models\Plant;

class ListPlant
{
    public static function call($order, $search)
    {
        $plant = Plant::order($order)->search($search);

        return $plant;
    }
}

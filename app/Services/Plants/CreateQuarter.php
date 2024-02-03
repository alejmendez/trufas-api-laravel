<?php

namespace App\Services\Plants;

use App\Models\Plant;

class CreatePlant
{
    public static function call($data): Plant
    {
        $plant = Plant::create($data);
        return $plant;
    }
}

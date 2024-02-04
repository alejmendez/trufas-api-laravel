<?php

namespace App\Services\Plants;

use App\Models\Plant;

class FindPlant
{
    public static function call($id)
    {
        $plant = Plant::findOrFail($id);

        return $plant;
    }
}

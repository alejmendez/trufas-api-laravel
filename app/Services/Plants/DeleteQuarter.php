<?php

namespace App\Services\Plants;

use App\Models\Plant;

class DeletePlant
{
    public static function call($id): void
    {
        Plant::destroy($id);
    }
}

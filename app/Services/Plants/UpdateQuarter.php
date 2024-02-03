<?php

namespace App\Services\Plants;

use App\Models\Plant;

class UpdatePlant
{
    public static function call($id, $data, $avatar): Plant
    {
        $plant = Plant::findOrFail($id);

        $blueprintRemove = $data['blueprintRemove'] ?? false;

        if ($blueprintRemove === true) {
            $data['blueprint'] = null;
        }

        $plant->update($data);

        return $plant;
    }
}

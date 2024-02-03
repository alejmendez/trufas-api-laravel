<?php

namespace App\Services\Quarters;

use App\Models\Quarter;

class UpdateQuarter
{
    public static function call($id, $data, $avatar): Quarter
    {
        $quarter = Quarter::findOrFail($id);

        $blueprintRemove = $data['blueprintRemove'] ?? false;

        if ($blueprintRemove === true) {
            $data['blueprint'] = null;
        }

        $quarter->update($data);

        return $quarter;
    }
}

<?php

namespace App\Services\Fields;

use App\Models\Field;

class FindField
{
    public static function call($id)
    {
        $field = Field::findOrFail($id);

        return $field;
    }
}

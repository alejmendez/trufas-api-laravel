<?php

namespace App\Services\Fields;

use App\Models\Field;

class CreateField
{
    public static function call($data): Field
    {
        $field = Field::create($data);
        return $field;
    }
}

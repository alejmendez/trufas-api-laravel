<?php

namespace App\Services\Fields;

use App\Models\Field;

class UpdateField
{
    public static function call($id, $data): Field
    {
        $field = Field::findOrFail($id);

        $field->update($data);

        return $field;
    }
}

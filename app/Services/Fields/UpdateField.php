<?php

namespace App\Services\Fields;

use App\Models\Field;

class UpdateField
{
    public static function call($id, $data): Field
    {
        $field = Field::findOrFail($id);

        $blueprintRemove = $data['blueprintRemove'] ?? false;

        if (!$data['blueprint']) {
            unset($data['blueprint']);
        }

        if ($blueprintRemove === true) {
            $data['blueprint'] = null;
        }

        $field->update($data);

        return $field;
    }
}

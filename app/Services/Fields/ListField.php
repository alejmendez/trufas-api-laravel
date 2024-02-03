<?php

namespace App\Services\Fields;

use App\Models\Field;

class ListField
{
    public static function call($order, $search)
    {
        $field = Field::order($order)->search($search);

        return $field;
    }
}

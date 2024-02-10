<?php

namespace App\Services\Fields;

use App\Models\Field;

class ListField
{
    public static function call($order, $search)
    {
        $fields = Field::order($order)->search($search);

        return $fields;
    }
}

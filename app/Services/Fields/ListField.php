<?php

namespace App\Services\Fields;

use App\Models\Field;

class ListField
{
    public static function call($filters, $order, $search)
    {
        $fields = Field::filter($filters)->order($order)->search($search);

        return $fields;
    }
}

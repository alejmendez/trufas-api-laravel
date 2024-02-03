<?php

namespace App\Services\Fields;

use App\Models\Field;

class DeleteField
{
    public static function call($id): void
    {
        Field::destroy($id);
    }
}

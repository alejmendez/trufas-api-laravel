<?php

namespace App\Services\Quarters;

use App\Models\Quarter;

class DeleteQuarter
{
    public static function call($id): void
    {
        Quarter::destroy($id);
    }
}

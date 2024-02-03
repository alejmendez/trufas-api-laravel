<?php

namespace App\Services\Users;

use App\Models\User;

class DeleteUser
{
    public static function call($id): void
    {
        User::destroy($id);
    }
}

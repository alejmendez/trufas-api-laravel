<?php

namespace App\Services\Users;

use App\Models\User;

class FindUser
{
    public static function call($id)
    {
        $user = User::with('roles')->findOrFail($id);

        return $user;
    }
}

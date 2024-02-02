<?php

namespace App\Services\Users;

use App\Models\User;

class ListUser
{
    public static function call($order, $search)
    {
        $users = User::with('roles')
            ->order($order)
            ->search($search);

        return $users;
    }
}

<?php

namespace App\Services\Users;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateUser
{
    public static function call($data): User
    {
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        if ($data['role']) {
            $user->assignRole($data['role']);
        }

        return $user;
    }
}

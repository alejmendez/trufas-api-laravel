<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $users = [
            [
                'Alejandro',
                'Méndez',
                'alejmendez.87@gmail.com',
                '26.604.667-7',
                'Super Admin'
            ],
            [
                'Fernando',
                'Undurraga',
                'fud@undo.cl',
                '30.052.194-0',
                'Administrador',
            ],
            [
                'Cristian',
                'Correa',
                'cristiancorreac@gmail.com',
                '30.335.289-9',
                'Administrador',
            ],
            [
                'Maria',
                'Campora',
                'camporamaria@gmail.com',
                '36.399.118-1',
                'Administrador',
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user[0],
                'last_name' => $user[1],
                'email' => $user[2],
                'dni' => $user[3],
                'password' => Hash::make('12345678'),
                'avatar' => null,
                'phone' => null,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ])->assignRole($user[4]);
        }
    }
}

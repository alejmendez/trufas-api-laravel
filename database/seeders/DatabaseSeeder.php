<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (User::count() > 0) {
            return;
        }

        $this->call([
            RolesSeeder::class,
            FieldsSeeder::class,
            QuartersSeeder::class,
            PlantsSeeder::class,
            HarvestsSeeder::class,
            UserSeeder::class,
        ]);
    }
}

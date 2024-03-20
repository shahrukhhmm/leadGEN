<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Sub Admin',
            'email' => 'subadmin@admin.com',
            'password' => Hash::make('password'),
            'role_id' => 2
        ]);
        \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@admin.com',
            'password' => Hash::make('password'),
            'role_id' => 3
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Sub User',
            'email' => 'subuser@admin.com',
            'password' => Hash::make('password'),
            'role_id' => 4
        ]);
    }
}

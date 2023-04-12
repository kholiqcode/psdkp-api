<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => 'password',
            'email_verified_at' => now(),
            'is_verified' => true,
        ])->assignRole('admin');

        \App\Models\User::create([
            'id' => 2,
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => 'password',
        ])->assignRole('user');
    }
}

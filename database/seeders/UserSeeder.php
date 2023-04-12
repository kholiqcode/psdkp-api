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
        $users = [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => '$2y$10$Fb50NW68CP6tJXNSAXllYegXwMS8HvvBwY4.Ws8r23ZCeQnOnVb6.', // password
            ],
            [
                'id' => 2,
                'name' => 'User',
                'email' => 'user@mail.com',
                'password' => '$2y$10$Fb50NW68CP6tJXNSAXllYegXwMS8HvvBwY4.Ws8r23ZCeQnOnVb6.', // password
            ],
        ];
        \App\Models\User::insert($users);
    }
}

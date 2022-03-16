<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Taylor Otwell',
            'email' => 'admin@technique',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
        ]);

        User::create([
            'name' => 'Taylor Otwell',
            'email' => 'user@technique',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
        ]);

        User::factory()
            ->count(9)
            ->hasProperties(2)
            ->create();
    }
}

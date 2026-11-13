<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@example.com')],
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'ChangeMe123!')),
                'role' => 'admin',
            ]
        );
    }
}
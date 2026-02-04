<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // BUYER
        User::firstOrCreate(
            ['email' => 'pembeli@gmail.com'],
            [
                'name' => 'Pembeli',
                'password' => Hash::make('pembeli'),
                'email_verified_at' => now(),
                'role' => 'buyer',
            ]
        );

        // SELLER
        User::firstOrCreate(
            ['email' => 'penjual@gmail.com'],
            [
                'name' => 'Penjual',
                'password' => Hash::make('penjual'),
                'email_verified_at' => now(),
                'role' => 'seller',
            ]
        );

        // ADMIN
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin'),
                'email_verified_at' => now(),
                'role' => 'admin',
            ]
        );
    }
}

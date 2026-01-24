<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pembeli
        $buyer = User::firstOrCreate(
            [
                'email' => 'pembeli@gmail.com'
            ],
            [
                'name' => 'Pembeli',
                'password' => Hash::make('pembeli'),
                'email_verified_at' => now(),
            ]
        );
        $buyer->assignRole('buyer');

        // Penjual
        $seller = User::firstOrCreate(
            [
                'email' => 'penjual@gmail.com'
            ],
            [
                'name' => 'Penjual',
                'password' => Hash::make('penjual'),
                'email_verified_at' => now(),
            ]
        );
        $seller->assignRole('seller');

        // Penjual
        $admin = User::firstOrCreate(
            [
                'email' => 'admin@gmail.com'
            ],
            [
                'name' => 'admin',
                'password' => Hash::make('admin'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');
    }
}

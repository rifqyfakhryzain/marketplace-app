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
        $buyer = User::firstOrCreate([
            'email' => 'pembeli@gmail.com'],
            [
                'name' => 'Pembeli',
                'password' => Hash::make('pembeli'),
                'email_verified_at' => now(),
            ]);
            $buyer->assignRole('buyer');
    }
}

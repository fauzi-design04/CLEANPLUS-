<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin User
        User::create([
            'name' => 'Admin CleanPlus',
            'email' => 'admin@cleanplusjambi.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567890',
            'address' => 'Jl. Gatot Subroto No. 123, Kota Jambi',
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        // Sample Customer 1
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => Hash::make('password123'),
            'phone' => '081298765432',
            'address' => 'Jl. Merdeka No. 45, Telanaipura, Kota Jambi',
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        // Sample Customer 2
        User::create([
            'name' => 'Siti Rahayu',
            'email' => 'siti@example.com',
            'password' => Hash::make('password123'),
            'phone' => '081355557777',
            'address' => 'Jl. Sudirman No. 78, Jambi Selatan, Kota Jambi',
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        // Sample Customer 3
        User::create([
            'name' => 'Ahmad Wijaya',
            'email' => 'ahmad@example.com',
            'password' => Hash::make('password123'),
            'phone' => '081366668888',
            'address' => 'Jl. Thamrin No. 56, Jelutung, Kota Jambi',
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        // Sample Customer 4
        User::create([
            'name' => 'Maya Sari',
            'email' => 'maya@example.com',
            'password' => Hash::make('password123'),
            'phone' => '081377779999',
            'address' => 'Jl. Pattimura No. 34, Kota Baru, Kota Jambi',
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        // Sample Customer 5
        User::create([
            'name' => 'Rudi Hermawan',
            'email' => 'rudi@example.com',
            'password' => Hash::make('password123'),
            'phone' => '081388880000',
            'address' => 'Jl. Diponegoro No. 89, Paal Merah, Kota Jambi',
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        // Tambahkan 10 user random (jika mau)
        User::factory(10)->create();
    }
}
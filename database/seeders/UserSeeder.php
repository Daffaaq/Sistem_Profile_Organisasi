<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

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
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'role' => 'superadmin',
            'password' => bcrypt('password'), // Menggunakan bcrypt untuk mengenkripsi kata sandi
        ]);

        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('password'), // Menggunakan bcrypt untuk mengenkripsi kata sandi
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@janur.com',
            'password' => Hash::make('admin123'),
            'no_hp' => '081234567890',
            'alamat' => 'Surabaya, Jawa Timur',
            'role' => 'admin',
        ]);

        // Create sample customer users
        User::factory(5)->customer()->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                // 'email' => 'admin@example.com',
                // 'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'nim' => null,
                'role' => 'admin',
                'is_approved' => true,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Verified Student User',
                // 'email' => 'student1@example.com',
                // 'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'nim' => '1111111111',
                'role' => 'student',
                'is_approved' => true,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Unverified Student User',
                // 'email' => 'student2@example.com',
                // 'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'nim' => '2222222222',
                'role' => 'student',
                'is_approved' => false,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

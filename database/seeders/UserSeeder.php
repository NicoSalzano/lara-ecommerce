<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin user',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Vendor user',
                'username' => 'vendor',
                'email' => 'vendor@example.com',
                'role' => 'vendor',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@example.com',
                'role' => 'user',
                'status' => 'active',
                'password' => bcrypt('password')
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@example.com')->first();
        $vendor = Vendor::create([
            'banner' => 'uploads/1234.jpg',
            'phone' => '13464861',
            'email'=> 'admin@example.com',
            'address'=> '123 Main Road',
            'description'=> 'this is a description',
            'user_id' => $user->id,
        ]);
    }
}

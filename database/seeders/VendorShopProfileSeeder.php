<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'vendor@example.com')->first();
        $vendor = Vendor::create([
            'banner' => 'uploads/1234.jpg',
            'phone' => '13464861',
            'shop_name' => 'Vendot shop',
            'email'=> 'vendor@example.com',
            'address'=> '123 Main Road',
            'description'=> 'this is a description',
            'user_id' => $user->id,
        ]);
    }
}

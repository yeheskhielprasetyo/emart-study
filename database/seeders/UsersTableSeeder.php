<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
             // admin
            'full_name' => 'Eki',
            'username' => 'Eki',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'status' => 'active',
        ],
        // vendor
        [
            'full_name' => 'Shanks',
            'username' => 'Vendor',
            'email' => 'vendor@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'vendor',
            'status' => 'active',
        ],
        // customer
        [
            'full_name' => 'Luffy',
            'username' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'customer',
            'status' => 'active',
        ]
    );


    }
}

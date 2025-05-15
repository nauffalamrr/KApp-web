<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Driver Satu',
            'username' => 'driver1',
            'password' => Hash::make('password'),
            'vehicle_type' => 'motorcycle',
            'status' => 'free'
        ]);

        User::create([
            'name' => 'Driver Dua',
            'username' => 'driver2',
            'password' => Hash::make('password'),
            'vehicle_type' => 'car',
            'status' => 'waiting'
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Add this line
use Illuminate\Support\Facades\Hash; // Add this line

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('admin')->insert([
            'adminId' => 1,
            'adminUsername' => 'admin',
            'adminPassword' => Hash::make('password'), // Replace 'password' with your desired password
        ]);
    }
}

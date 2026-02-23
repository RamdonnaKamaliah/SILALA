<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'user 1',
            'phone' => '0823547482',
            'email' => 'user@gmail.com',
            'membership_type' => 'karyawan',
            'membership_type' => 'pengunjung',
            'gender' => 'P',
            'password' => 'user123' 
        ]);
    }
}
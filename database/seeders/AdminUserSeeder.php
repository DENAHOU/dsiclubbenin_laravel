<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('email', 'admin@clubdsibenin.org')->exists()) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'admin@clubdsibenin.org',
                'password' => Hash::make('Admin@2025'),
                'role' => 'admin',
                'status' => 'approved',
                'is_paid' => 1,
                'phone' => 'null',
                'username' => 'super_admin'
            ]);
        }
    }
}

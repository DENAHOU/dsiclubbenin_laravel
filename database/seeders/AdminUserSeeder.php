<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        if (!Admin::where('email', 'admin@clubdsibenin.org')->exists()) {
            Admin::create([
                'name' => 'Super Admin',
                'email' => 'admin@clubdsibenin.org',
                'password' => Hash::make('Admin@2025')
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TresorUserSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('email', 'tresor@clubdsibenin.org')->exists()) {
            User::create([
                'name' => 'Trésorier du Club',
                'email' => 'tresor@clubdsibenin.org',
                'password' => Hash::make('Tresor@2025'),
                'role' => 'tresor',
                'status' => 'approved',
                'is_paid' => 1,
                'phone' => 'null',
                'username' => 'tresor_dsi'
            ]);
        }
    }
}

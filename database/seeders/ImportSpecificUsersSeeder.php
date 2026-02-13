<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ImportSpecificUsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'name' => 'admin_dsi',
                'email' => 'contact@clubdsibenin.org',
                'password' => '$2y$10$jj4DTsFKiERjqUBn20Te.up7BPPCRCRA9EtR173oibcp7ySooafua',
            ],
            [
                'id' => 3,
                'name' => 'admin_cog_0',
                'email' => 'admin@clubdsibenin.bj',
                'password' => '$2y$10$jj4DTsFKiERjqUBn20Te.up7BPPCRCRA9EtR173oibcp7ySooafua',
            ],
            [
                'id' => 27,
                'name' => 'admin_patricia',
                'email' => 'patricia.senou@clubdsibenin.org',
                'password' => '$2y$10$jj4DTsFKiERjqUBn20Te.up7BPPCRCRA9EtR173oibcp7ySooafua',
            ],
            [
                'id' => 115437,
                'name' => 'adminxp',
                'email' => 'adminxp@gmail.com',
                'password' => '$2y$10$j5HePCyvp.vVzVlEVzTho.eQ.weYzBet/4PCuEFu6.FDdnEfO0HbK',

                
            ],
        ];

        foreach ($users as $user) {

            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'username' => $user['name'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'role' => 'membre',
                    'status' => 'approved',
                    'is_paid' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}

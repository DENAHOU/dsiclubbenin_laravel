<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BoardRole;

class BoardRoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'Président', 'priority' => 1],
            ['name' => 'Vice-Président', 'priority' => 2],
            ['name' => 'Secrétaire Général', 'priority' => 3],
            ['name' => 'Secrétaire Général Adjoint', 'priority' => 4],
            ['name' => 'Trésorier Général', 'priority' => 5],
            ['name' => 'Trésorier Général Adjoint', 'priority' => 6],
            ['name' => 'Sécrétaire Général Communication', 'priority' => 7],
            ['name' => 'Sécrétaire Général Communication Adjoint', 'priority' => 8],
        ];

        foreach ($roles as $role) {
            BoardRole::create($role);
        }
    }
}

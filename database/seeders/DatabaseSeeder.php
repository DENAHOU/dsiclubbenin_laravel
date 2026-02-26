<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();



            // ...
            $this->call([
                AdminUserSeeder::class,
                BoardRoleSeeder::class,
                ImportUsersFromClubdsibeninProdSeeder::class,
                ImportPaymentsFromDSIMembersSeeder::class,
                ImportEsnsSeeder::class,
                ImportBoardMembersSeeder::class,

                // Vous pouvez ajouter d'autres seeders ici
            ]);

    }
}

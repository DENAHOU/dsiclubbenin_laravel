<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\User; // Modèle Eloquent User
use App\Models\BoardMember; // Modèle Eloquent BoardMember si tu en as un

class ImportBoardMembersSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer les membres depuis l'ancienne table
        $members = DB::connection('base_clubdsibenin_prod')
            ->table('member_of_offices')
            ->get();

        // Mapping jobs → role_id
        $roleMap = [
            'PRÉS' => 1,
            'PR'   => 1,
            'SG'   => 3,
            'SGA'  => 4,
            'TG'   => 5,
            'TGA'  => 6,
            'SGCom' => 7,
            'SGACom' => 8,
        ];

        foreach ($members as $item) {
            $roleId = $roleMap[$item->jobs] ?? null;

            if (!$roleId) {
                continue; // ignorer si le job n'est pas mappé
            }

            // Récupérer le user via Eloquent
            $user = User::find($item->member_id);

            if (!$user) {
                continue; // ignorer si l'user n'existe pas
            }

            // Préparer le chemin de la photo
            $photo = Str::slug($user->firstname . ' ' . $user->lastname) . '.jpg';
            $photoPath = file_exists(storage_path('app/public/profile/' . $photo))
                ? 'profile/' . $photo
                : null;

            // Mettre à jour le chemin de la photo
            $user->photo_path = $photoPath;
            $user->save();

            // Insérer ou mettre à jour le board_member
            DB::table('board_members')->updateOrInsert(
                [
                    'user_id' => $user->id,
                    'role_id' => $roleId,
                ],
                [
                    'company_id' => null,
                    'administration_id' => null,
                    'college_id' => null,
                    'start_date' => $item->created_at ?? Carbon::now(),
                    'end_date' => null,
                    'status' => 'active',
                    'speech' => $item->word_of_interests ?? null,
                    'created_at' => $item->created_at ?? Carbon::now(),
                    'updated_at' => $item->updated_at ?? Carbon::now(),
                ]
            );
        }
    }
}

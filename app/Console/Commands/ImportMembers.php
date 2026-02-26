<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ImportMembers extends Command
{
    protected $signature = 'import:members';
    protected $description = 'Importer les membres depuis clubdsibenin_prod';

    public function handle()
    {
        $oldMembers = DB::connection('base_clubdsibenin_prod')
            ->table('members')
            ->leftJoin('users', 'members.user_id', '=', 'users.id')
            ->leftJoin('medias', 'members.medias_id', '=', 'medias.id')
            ->select(
                'members.*',
                'users.email',
                'medias.filename as photo'
            )
            ->get();

        $this->info("Nombre de membres trouvés : " . $oldMembers->count());

        foreach ($oldMembers as $member) {

            $status = match ($member->status) {
                'approved' => 'approved',
                'awaiting_admin_review' => 'pending',
                default => 'approved'
            };

            // Génération username unique
            $username = Str::slug($member->firstname . '.' . $member->lastname);

            $sexe = null;

            if ($member->gender) {
                $gender = strtolower(trim($member->gender));

                if (str_contains($gender, 'homme')) {
                    $sexe = 'M';
                } elseif (str_contains($gender, 'femme')) {
                    $sexe = 'F';
                }
            }

            $birthday = null;

            if (!empty($member->birthday) && $member->birthday !== '0000-00-00') {
                $birthday = $member->birthday;
            }

            $createdAt = $member->created_at;
            if ($createdAt == '0000-00-00 00:00:00' || empty($createdAt)) {
                $createdAt = null; // ou null si ta colonne accepte NULL
            }


            DB::table('users')->updateOrInsert(
                ['email' => $member->email],
                [
                    'username' => $username, // ✅ AJOUT IMPORTANT

                    'name' => $member->firstname . ' ' . $member->lastname,
                    'firstname' => $member->firstname,
                    'lastname' => $member->lastname,
                    'email' => $member->email,

                    'password' => Hash::make('password123'),

                    'role' => 'member',
                    'status' => $status,
                    'is_paid' => 1,

                    'phone' => $member->phone,
                    'birthday' => $birthday,
                    'sexe' => $sexe,

                    'current_position' => $member->current_position_of_responsibility,
                    'current_employer' => $member->current_employer,
                    'sector' => $member->sector,
                    'area_of_expertise' => $member->area_of_expertise,
                    'initial_training' => $member->initial_training,
                    'category_of_service' => $member->category_of_service,
                    'description' => $member->description,

                    'photo_path' => $member->photo
                        ? 'Aphotos/' . $member->photo
                        : null,

                    'created_at' => $createdAt,
                    'updated_at' => $member->updated_at ?? now(),

                ]
            );
        }


        $this->info('✅ Import terminé avec succès !');
    }
}

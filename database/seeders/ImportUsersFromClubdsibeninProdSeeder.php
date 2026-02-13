<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class ImportUsersFromClubdsibeninProdSeeder extends Seeder
{
    public function run()
    {
        // On utilise une transaction pour plus de sécurité
        DB::connection('mysql')->transaction(function () {

            $users = DB::connection('base_clubdsibenin_prod')
                ->table('users as u')
                ->leftJoin('members as m', 'm.user_id', '=', 'u.id')
                ->select(
                    'u.id',
                    'u.name',
                    'u.email',
                    'u.email_verified_at',
                    'u.password',
                    'u.role',
                    'u.remember_token',
                    'u.created_at',
                    'u.updated_at',
                    'u.active_status',

                    'm.firstname',
                    'm.lastname',
                    'm.gender',
                    'm.phone',
                    'm.birthday',
                    'm.employer_contact',
                    'm.current_position_of_responsibility',
                    'm.current_employer',
                    'm.sector',
                    'm.area_of_expertise',
                    'm.initial_training',
                    'm.description',
                    'm.category_of_service',
                    'm.status as type_members'
                )
                ->get();

            foreach ($users as $user) {

                // Vérifier si l'email existe déjà
                if (DB::table('users')->where('email', $user->email)->exists()) {
                    continue;
                }

                // === Gestion des dates ===
                $createdAt = ($user->created_at && $user->created_at != '0000-00-00 00:00:00') 
                                ? $user->created_at 
                                : now();
                $updatedAt = ($user->updated_at && $user->updated_at != '0000-00-00 00:00:00') 
                                ? $user->updated_at 
                                : now();
                $birthday = ($user->birthday && $user->birthday != '0000-00-00') 
                                ? $user->birthday 
                                : null;
                $emailVerifiedAt = ($user->email_verified_at && $user->email_verified_at != '0000-00-00 00:00:00') 
                                ? $user->email_verified_at 
                                : null;

                // === Gestion du status (enum) ===
                switch ($user->active_status) {
                    case 1:
                        $status = 'approved';
                        break;
                    case 2:
                        $status = 'rejected';
                        break;
                    case 3:
                        $status = 'blocked';
                        break;
                    default:
                        $status = 'pending';
                }

                $sexe = null;
                if (isset($user->gender)) {
                    $gender = strtolower($user->gender);
                    if ($gender === 'homme' || $gender === 'm') $sexe = 'M';
                    elseif ($gender === 'femme' || $gender === 'f') $sexe = 'F';
                    else $sexe = null; // inconnu ou autre
                }


                // === Insertion dans la table users de la base B ===
                DB::table('users')->insert([
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => $emailVerifiedAt,
                    'password' => $user->password,
                    'role' => $user->role,

                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'photo_path' => $user->profile_photo_path ?? (isset($user->avatar) ? $user->avatar : null),
                    'sexe' => $sexe,
                    'phone' => $user->phone,
                    'birthday' => $birthday,
                    'employer_contact' => $user->employer_contact,
                    'type_members' => $user->type_members,
                    'current_position' => $user->current_position_of_responsibility,
                    'current_employer' => $user->current_employer,
                    'sector' => $user->sector,
                    'area_of_expertise' => $user->area_of_expertise,
                    'initial_training' => $user->initial_training,
                    'description' => $user->description,
                    'category_of_service' => $user->category_of_service,

                    'remember_token' => $user->remember_token,
                    'created_at' => $createdAt,
                    'updated_at' => $updatedAt,
                    'status' => $status,
                    'is_paid' => false,
                ]);
            }
        });
    }
}

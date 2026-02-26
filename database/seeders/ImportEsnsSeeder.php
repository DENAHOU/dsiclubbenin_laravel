<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ImportEsnsSeeder extends Seeder
{
    public function run(): void
    {
        $esns = DB::connection('base_clubdsibenin_prod')
            ->table('e_numeriques')
            ->get();

        foreach ($esns as $item) {

            // Générer slug basé sur le nom entreprise
            $slug = Str::slug($item->NomEntreprise);

            $logoPath = null;

            // Extensions possibles
            $extensions = ['png', 'jpg', 'jpeg', 'webp'];

            foreach ($extensions as $ext) {
                $file = storage_path("app/public/logos/{$slug}.{$ext}");
                if (File::exists($file)) {
                    $logoPath = "logos/{$slug}.{$ext}";
                    break;
                }
            }

            DB::table('esns')->updateOrInsert(
                ['id' => $item->id],
                [
                    'promoter_name'      => $item->NomEntreprise ?? 'Promoteur ESN',
                    'civility'           => $item->Civilite,
                    'company_name'       => $item->NomEntreprise,
                    'professional_email' => strtolower(
                        preg_replace('/[^a-zA-Z0-9]/', '', $item->NomEntreprise)
                    ) . '@esn.local',
                    'professional_phone' => $item->PhonePro,
                    'location'           => $item->Emplacement,
                    'legal_form'         => $item->FormeJuridique,
                    'website_url'        => $item->Url,
                    'activity_domain'    => $item->DomaineActivite,
                    'creation_date'      => $item->DateCreation,
                    'experience_years'   => $item->AnneeExperience,
                    'staff_count'        => $item->NombrePersonnel,
                    'turnover'           => $item->ChiffreAffaire,
                    'esn_type'           => $item->TypeEsn,
                    'description'        => $item->description,
                    'trade_register_path'=> null,
                    'logo_path'          => $logoPath,
                    'password'           => Hash::make('password123'),
                    'remember_token'     => null,
                    'created_at'         => $item->created_at ?? Carbon::now(),
                    'updated_at'         => $item->updated_at ?? Carbon::now(),
                ]
            );
        }

        $this->command->info('Import ESN avec logos terminé ✅');
    }
}

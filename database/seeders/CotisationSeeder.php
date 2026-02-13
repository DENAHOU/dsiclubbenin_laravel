<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cotisation;

class CotisationSeeder extends Seeder
{
    public function run()
    {
        $cotisations = [
            ['name' => 'Fanick ATCHIA', 'company' => 'APM Terminals, Groupe Maersk', 'amount' => 360000],
            ['name' => 'Wachinou Vincent Anselme DEDJINOU', 'company' => 'MPKOU', 'amount' => 350000],
            ['name' => 'James Hermann SECLONDE', 'company' => 'Autorité de Régulation des Communiations Electroniques et de la Poste', 'amount' => 360000],
            ['name' => 'Eric BOSSOU', 'company' => 'NYQUIST-SHANNON', 'amount' => 350000],
            ['name' => 'LUC AGOSSA', 'company' => 'Cisco Systems', 'amount' => 280000],
            ['name' => 'Jean-Baptiste Otte', 'company' => 'USAID', 'amount' => 115000],
            ['name' => 'Serges Avodagbe', 'company' => 'Kinessor Group Conseil', 'amount' => 90000],
            ['name' => 'Maximilien F. KPODJEDO', 'company' => 'Gouvernement - Presidence de la Republique', 'amount' => 395000],
            ['name' => 'Liamidi LAGUIDE', 'company' => 'Ministère du Plan et du Développement (MPD)', 'amount' => 265000],
            ['name' => 'David C CARRENA', 'company' => 'Group Vivendi Africa (GVA)', 'amount' => 340000],
            ['name' => 'Ibouraim Tade', 'company' => 'UNDP Benin', 'amount' => 345000],
            ['name' => 'Désiré Luc Cocou SOUKPO', 'company' => 'Ministère du Numérique et de la Digitalisation', 'amount' => 5000],
            ['name' => 'Sabin Sogan', 'company' => 'ANSSI-Bénin', 'amount' => 55000],
            ['name' => 'Yves OTTE', 'company' => 'MIKEMTECHNOLOGIE', 'amount' => 80000],
            ['name' => 'Maixent MANOUMBA', 'company' => 'GRIMALDI BENIN', 'amount' => 300000],
            ['name' => 'Aurore DJOKONON', 'company' => 'PAM', 'amount' => 15000],
            ['name' => 'Azizou SALE', 'company' => 'CNSS', 'amount' => 310000],
            ['name' => 'Maxime HINSON', 'company' => 'Ministère de l\'Enseignement Supérieur et de la Recherche Scientifique', 'amount' => 270000],
            ['name' => 'Faihun Ago Christelle', 'company' => 'BOA', 'amount' => 365000],
            ['name' => 'SANTANNA Lambert', 'company' => 'CICA-RE', 'amount' => 270000],
            ['name' => 'Yves ASSOGBA', 'company' => 'SONEB', 'amount' => 345000],
            ['name' => 'Henri Marcel Emmanuel DA SILVA', 'company' => 'United Mission in South Sudan (UNMISS)', 'amount' => 165000],
            ['name' => 'Wilfried GANDAHO', 'company' => 'Ministère du Travail et de la Fonction Publique', 'amount' => 255000],
            ['name' => 'Youssouf ABDOULHALIM', 'company' => 'Bénin Control', 'amount' => 225000],
            ['name' => 'ALAIN AHOUNOU', 'company' => 'Ministère de l\'Economie et des Finances', 'amount' => 325000],
            ['name' => 'ADANLIN TOUPE MIREILLE', 'company' => 'SGB', 'amount' => 350000],
            ['name' => 'Loïc KINDJI', 'company' => 'Oragroup', 'amount' => 65000],
            ['name' => 'ALAIN GBAGUIDI', 'company' => 'DIGITAL WORLD TECHNOLOGY', 'amount' => 365000],
            ['name' => 'Thierry AHOUASSOU', 'company' => 'ASSI', 'amount' => 255000],
            ['name' => 'OSSENI Rachide ABDOULAYE', 'company' => 'Ministère de l\'Agriculture, de l\'Elevage et de la Pêche', 'amount' => 25000],
            ['name' => 'Bouraima ADAMOU', 'company' => 'Ministère de l\'Intérieur', 'amount' => 195000],
            ['name' => 'Karel AGBANTE', 'company' => 'ONG Centre Songhaï', 'amount' => 45000],
            ['name' => 'Abdou Ambarka', 'company' => 'Cité de l\'Innovation, SEME CITY', 'amount' => 75000],
            ['name' => 'Eric DEGBOEVI', 'company' => 'MTN', 'amount' => 190000],
            ['name' => 'Mawuénan Hervé Guy AKAKPO DJIHOUNTRY', 'company' => 'Caisse Autonome d\'Amortissement (CAA)', 'amount' => 325000],
            ['name' => 'Josepha HODE', 'company' => 'MTN', 'amount' => 270000],
            ['name' => 'Mouftaou BELLO', 'company' => 'SAHAM ASSURANCE VIE', 'amount' => 80000],
            ['name' => 'Joseph Mensah ABALLO', 'company' => 'UBA', 'amount' => 345000],
            ['name' => 'PAUL ACAKPO', 'company' => 'directeur de l\'informatique au trésor public du bénin', 'amount' => 220000],
            ['name' => 'Tania Sêdé ADJAGAN', 'company' => 'AFDB', 'amount' => 150000],
            ['name' => 'Paul ADJAHI', 'company' => 'Etisalat Benin (Moov)', 'amount' => 345000],
            ['name' => 'Honorine ADJIBI DEDJINOU', 'company' => 'Bénin Télécoms Infrastructures SA', 'amount' => 255000],
            ['name' => 'Irénée ADJOFOGUE', 'company' => 'HeildelbergCement', 'amount' => 340000],
            ['name' => 'AGBATO Antonyo Junior F. Y.', 'company' => 'SGI-BENIN', 'amount' => 280000],
            ['name' => 'Patrick Vital AGBOKOU', 'company' => 'Société des Aéroports du BÉNIN', 'amount' => 25000],
            ['name' => 'Amour Eliakim Noudéhou AGBONON', 'company' => 'Ministère de l\'Economie et des Finances Bénin', 'amount' => 370000],
            ['name' => 'Sèwanou Christian AGONVINON', 'company' => 'ETAT MJL', 'amount' => 130000],
            ['name' => 'Larris Lyké AGOSSOU', 'company' => 'CESCA', 'amount' => 155000],
            ['name' => 'Roland AIKPE', 'company' => 'Optimal Solutions', 'amount' => 25000],
            ['name' => 'AMAMION Alban', 'company' => 'UNFPA Benin', 'amount' => 95000],
            ['name' => 'Falilou Assani', 'company' => 'Consultant', 'amount' => 30000],
            ['name' => 'Morel Raoul AZANHOUE', 'company' => 'Plan International Benin', 'amount' => 40000],
            ['name' => 'Marthe BANKOLE', 'company' => 'BOA BENIN', 'amount' => 400000],
            ['name' => 'Franck Kossi BOSSOU', 'company' => 'BOA BÉNIN', 'amount' => 150000],
            ['name' => 'ADONON Cyrille', 'company' => 'SBEE', 'amount' => 310000],
            ['name' => 'G. Jacques DANSOU', 'company' => 'HELVETAS BENIN', 'amount' => 25000],
            ['name' => 'Romuald DJISSA', 'company' => 'Quality corporate', 'amount' => 190000],
            ['name' => 'Cossi Gilbert GOUDJINOU', 'company' => 'SBIN', 'amount' => 345000],
            ['name' => 'Grégoire GOUCLOUNON', 'company' => 'L\'AFRICAINE VIE', 'amount' => 215000],
            ['name' => 'Roland KINHA', 'company' => 'NSIA BANQUE TOGO', 'amount' => 315000],
            ['name' => 'Luc Yéssoufou KOSSOKO', 'company' => 'OHADA/ERSUMA', 'amount' => 220000],
            ['name' => 'Ayite Eric Dieu-Donné KOUDJINA', 'company' => 'CCEI BANK BENIN', 'amount' => 40000],
            ['name' => 'YVES HAROLD KPANOU', 'company' => 'Group Banque Of Africa', 'amount' => 120000],
            ['name' => 'Imourane LEKOYO', 'company' => 'APDP', 'amount' => 10000],
            ['name' => 'Damien MAGNON', 'company' => 'AFRINERGIES ONG', 'amount' => 275000],
            ['name' => 'Zoulikifouli MARCOS', 'company' => 'ASSEMBLEE NATIONALE', 'amount' => 25000],
            ['name' => 'Ouanilo MEDEGAN', 'company' => 'ANSSI', 'amount' => 280000],
            ['name' => 'WILLIAM MIGAN', 'company' => 'Ecobank Transnational Incorporated', 'amount' => 285000],
            ['name' => 'Agésilas NATA', 'company' => 'Ministère du Tourisme, de la Culture et des Arts', 'amount' => 180000],
            ['name' => 'Abdoul Matine OUSMANE', 'company' => 'COUR SUPREME', 'amount' => 30000],
            ['name' => 'Gad OUSSOU', 'company' => 'METEO BENIN', 'amount' => 250000],
            ['name' => 'Roméo PRUDENCIO', 'company' => 'Banque Internationale pour l\'Industrie et le Commerce', 'amount' => 270000],
            ['name' => 'TEGUO ROMARIC CYRILLE', 'company' => 'SAAR Benin', 'amount' => 25000],
            ['name' => 'Alidou SARE', 'company' => 'ANDF', 'amount' => 50000],
            ['name' => 'Nelly Yolande Sodohoue', 'company' => 'CNCB', 'amount' => 35000],
            ['name' => 'Bonaventure K SOSSA', 'company' => 'Administration', 'amount' => 20000],
            ['name' => 'Alexandre SOTONDJI', 'company' => 'CORIS BANK INTERNATIONAL BENIN', 'amount' => 85000],
            ['name' => 'Géraud TOSSOU', 'company' => 'Direction Générale des Impôts', 'amount' => 350000],
            ['name' => 'MEGNIGBETO Vincent de Paul', 'company' => 'Ministère des Affaires Sociales et de la Microfinance', 'amount' => 330000],
            ['name' => 'William KODJIA', 'company' => 'SBIN', 'amount' => 80000],
            ['name' => 'Landry ZEKPA', 'company' => 'UBA BENIN', 'amount' => 50000],
            ['name' => 'G. Fabrice DAKO', 'company' => 'TECHNODATA SOLUTIONS', 'amount' => 400000],
            ['name' => 'Tchankpega Israël SANSIMA', 'company' => 'MDN', 'amount' => 85000],
            ['name' => 'SOBABE ALI TAHIROU Abdou-Aziz', 'company' => 'MAEP', 'amount' => 155000],
            ['name' => 'A. Olivier TOBOSSI', 'company' => 'Mairie de Cotonou', 'amount' => 340000],
            ['name' => 'TOSSAVI KODJO PATRICE', 'company' => 'OHADA', 'amount' => 350000],
            ['name' => 'Yacoubou BOURAIMA', 'company' => 'SIPI-BENIN', 'amount' => 345000],
            ['name' => 'Vincent Zossou', 'company' => 'Assistance Publique - Hôpitaux de Paris', 'amount' => 340000],
            ['name' => 'Youssouf ABOUBAKARI', 'company' => 'SHB', 'amount' => 360000],
            ['name' => 'G. Vivien ASSANGBE WOTTO', 'company' => 'BENIN TELECOM INFRASTRUCTURES', 'amount' => 30000],
            ['name' => 'Abdias ATCHADE', 'company' => 'SODECO SA', 'amount' => 350000],
            ['name' => 'BEDIE KPOTIN Carine', 'company' => 'NATUFRUITS Sarl', 'amount' => 320000],
            ['name' => 'Armand BODJRENOU', 'company' => 'BAD', 'amount' => 280000],
            ['name' => 'HERMANN BOKPE', 'company' => 'SOBEBRA', 'amount' => 345000],
            ['name' => 'Sarah GANDJI', 'company' => 'Consultant', 'amount' => 360000],
            ['name' => 'Fréjus GBAGUIDI', 'company' => 'Chef de projet', 'amount' => 260000],
            ['name' => 'Thierry GOUTONDJI', 'company' => 'NSIA VIE ASSURANCES', 'amount' => 315000],
            ['name' => 'Marionne Alida S. Adjignon Houeto', 'company' => 'L\' Africaine des Assurances', 'amount' => 350000],
            ['name' => 'MARIETTE KWADZO-AKPOTSUI', 'company' => 'Consultante', 'amount' => 295000],
            ['name' => 'Jean-Paul LEGONOU', 'company' => 'MAERSK BENIN SA', 'amount' => 215000],
            ['name' => 'Oladélé LIAMIDI', 'company' => 'Nouvelle Cimenterie du Bénin', 'amount' => 125000],
            ['name' => 'ZANNOU Virgile', 'company' => 'ORABANK BENIN', 'amount' => 280000],
            ['name' => 'Kokou KOFFI', 'company' => 'SESUR SA', 'amount' => 20000],
            ['name' => 'issiakou SOULEYMANE', 'company' => 'EMN', 'amount' => 140000],
            ['name' => 'Mohamed ASSOUMA SEIDOU', 'company' => 'Fonds National de Développement Agricole', 'amount' => 25000],
            ['name' => 'Kossi Eudes HOUNDJO', 'company' => 'Directeur des Système d\'Information / Ministère de la Décentralisation', 'amount' => 5000],
            ['name' => 'M\'BOUEKE LIONEL AXEL EFFOUE', 'company' => 'SGDS SA', 'amount' => 190000],
            ['name' => 'Olabiyi Patrick YAYI', 'company' => 'Consultant', 'amount' => 5000],
            ['name' => 'Sagbo Victorin Yvonnick AZA-GNANDJI', 'company' => 'DSI-MESTFP', 'amount' => 5000],
            ['name' => 'Irnst FANOU', 'company' => 'APIEx', 'amount' => 5000],
            ['name' => 'Tafsir Mamour Ndiaye', 'company' => 'SBIN', 'amount' => 45000],
            ['name' => 'Eunice PEDRO', 'company' => 'MTFP', 'amount' => 100000],
            ['name' => 'Abiola Mariel Youri ATTONDE', 'company' => 'Agence Nationale d\'Identification des Personnes', 'amount' => 50000],
            ['name' => 'Selome Aubin Charles ASSOUHAN', 'company' => 'COMAN SA, APM Terminals, MAERSK', 'amount' => 70000],
            ['name' => 'Afiss BILEOMA', 'company' => 'MCA BENIN REGIONAL', 'amount' => 150000],
            ['name' => 'Steven Bassa', 'company' => 'METIS', 'amount' => 140000],
            ['name' => 'Rodolphe AGANI', 'company' => 'PN-BENIN', 'amount' => 70000],
            ['name' => 'Arthur ODO', 'company' => 'OKA PARTNERS', 'amount' => 80000],
            ['name' => 'Girès Charlie Dègnon Djidjoho ZINSOU', 'company' => 'ASIN', 'amount' => 40000],
            ['name' => 'Éric GNACADJA', 'company' => 'IOKEO', 'amount' => 170000],
            ['name' => 'Bocar Abdoul KELLY', 'company' => 'SBIN', 'amount' => 110000],
            ['name' => 'Gerlix ADANKON', 'company' => 'RIGHTCOM', 'amount' => 80000],
            ['name' => 'Hounnalémi Marius Bellor GANHOUNOUTO', 'company' => 'Projet WURI BENIN', 'amount' => 10000],
            ['name' => 'MEGUIDA CHAMES-DINE', 'company' => 'BENIN PETRO', 'amount' => 120000],
            ['name' => 'Mathias HOUNGBO', 'company' => 'BCEAO', 'amount' => 15000],
            ['name' => 'Romuald C.C TOSSOU', 'company' => 'SOFT-IT', 'amount' => 45000],
            ['name' => 'Wankossi Milca TONATO', 'company' => 'ADPME', 'amount' => 75000],
            ['name' => 'Brice HESSOU', 'company' => 'Directeur des Systèmes d\'Information chez CELTIIS', 'amount' => 40000],
            ['name' => 'Axel FOADEY', 'company' => 'AGENCE NATIONALE DES TRANSPORTS TERRESTRES', 'amount' => 75000],
            ['name' => 'Modeste Parfait BESSAN', 'company' => 'BANK OF AFRICA BENIN', 'amount' => 5000],
            ['name' => 'Saïd JEKINNOU', 'company' => 'SBIN', 'amount' => 0],
            ['name' => 'Semako Charles HOUETO', 'company' => 'ABMed', 'amount' => 50000],
            ['name' => 'Akangbégnon Iréné ADJOVI', 'company' => 'ASIN', 'amount' => 50000],
            ['name' => 'Anthelme HOUINDOTE', 'company' => 'FLUDOR BENIN S.A', 'amount' => 15000],
            ['name' => 'Cossi Hospice Francky BOCO', 'company' => 'UBPHAR SA', 'amount' => 15000],
            ['name' => 'Ahotondji Philémon GBAGUIDI', 'company' => 'Mairie de Nikki', 'amount' => 35000],
            ['name' => 'ULRICH SETCHEDO IGOR AGBIMADOU', 'company' => 'GAB S.A', 'amount' => 25000],
            ['name' => 'Adonis Morel BOHOUN', 'company' => 'Agence Pénitentiaire du Bénin', 'amount' => 35000],
            ['name' => 'Jean-Carmel AKPACA', 'company' => 'SImAU Bénin', 'amount' => 30000],
            ['name' => 'AUREL GUIDI', 'company' => 'BIIC', 'amount' => 0],
            ['name' => 'Fréjus Cédrick COUAO-ZOTTI', 'company' => 'CNHU-HKM', 'amount' => 5000],
            ['name' => 'EMILE DEMOU', 'company' => 'NSIA BANQUE BENIN SA', 'amount' => 5000],
            ['name' => 'Carlos KOTI', 'company' => 'MONT SINAÏ', 'amount' => 10000],
            ['name' => 'Souliatou IDI', 'company' => 'Diane SINTONDJI', 'amount' => 10000],
            ['name' => 'Vidjannangni Romaric', 'company' => 'N/A', 'amount' => 10000],
            ['name' => 'KEITCHION Privat Mueln Degnissou', 'company' => 'N/A', 'amount' => 0],
        ];

        $successCount = 0;
        $failCount = 0;

        foreach ($cotisations as $cotisation) {
            $user = User::whereRaw("CONCAT(firstname, ' ', lastname) = ?", [$cotisation['name']])->first();
            
            if ($user) {
                Cotisation::create([
                    'user_id' => $user->id,
                    'months' => intval($cotisation['amount'] / 5000),
                    'amount' => $cotisation['amount'],
                    'payment_reference' => $cotisation['company'],
                    'status' => $cotisation['amount'] >= 350000 ? 'paid' : 'pending',
                ]);
                
                $successCount++;
                echo "✅ Cotisation créée pour: " . $cotisation['name'] . " (" . $cotisation['amount'] . " FCFA)\n";
            } else {
                $failCount++;
                echo "❌ Utilisateur non trouvé: " . $cotisation['name'] . "\n";
            }
        }

        echo "\n📊 RÉSUMÉ:\n";
        echo "✅ Succès: $successCount cotisations créées\n";
        echo "❌ Échec: $failCount utilisateurs non trouvés\n";
        echo "📝 Total traité: " . ($successCount + $failCount) . " membres\n";
    }
}

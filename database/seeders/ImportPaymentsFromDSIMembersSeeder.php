<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;

class ImportPaymentsFromDSIMembersSeeder extends Seeder
{
    public function run()
    {
        DB::connection('mysql')->transaction(function () {

            $payments = DB::connection('base_clubdsibenin_prod')
                ->table('dsi_members')
                ->whereNull('deleted_at') // ignorer les paiements supprimés
                ->get();

            foreach ($payments as $payment) {

                // Vérifier que le membre existe dans la base B
                $userExists = DB::table('users')->where('id', $payment->member_id)->exists();
                if (!$userExists) {
                    continue;
                }

                // Gérer les dates
                $createdAt = ($payment->created_at && $payment->created_at != '0000-00-00 00:00:00')
                                ? $payment->created_at
                                : now();

                $updatedAt = ($payment->updated_at && $payment->updated_at != '0000-00-00 00:00:00')
                                ? $payment->updated_at
                                : now();

                // Vérifier que amount est numérique
                $amount = is_numeric($payment->amount) ? $payment->amount : 0;

                // Vérifier transaction_id
                $transactionId = $payment->transaction_id ?? 'unknown';

                // --- Insérer dans payment ---
                DB::table('payments')->insert([
                    'payable_type' => \App\Models\User::class,    // Tous les membres sont des users
                    'payable_id' => $payment->member_id,
                    'transaction_id' => $transactionId,
                    'amount' => $amount,
                    'currency' => 'XOF',               // ou autre si tu veux
                    'payment_method' => 'unknown',     // par défaut
                    'status' => 'completed',           // par défaut
                    'start_date' => $createdAt,
                    'end_date' => $updatedAt,
                    'meta' => json_encode(['transaction_fees' => $payment->transaction_fees]),
                    'created_at' => $createdAt,
                    'updated_at' => $updatedAt,
                ]);

                // --- Mettre is_paid = 1 pour l'user correspondant ---
                DB::table('users')
                    ->where('id', $payment->member_id)
                    ->update([
                        'is_paid' => 1,
                        'payment_reference' => null, // reste null
                    ]);
            }
        });
    }
}

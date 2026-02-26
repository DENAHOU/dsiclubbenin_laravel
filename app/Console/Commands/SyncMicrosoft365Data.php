<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\MicrosoftSyncService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncMicrosoft365Data extends Command
{
    protected $signature = 'microsoft:sync {--user-id= : Sync pour un utilisateur spécifique (ID)}';
    protected $description = 'Synchronise les données Microsoft 365 (Calendrier, Documents, Teams) pour tous les utilisateurs SSO';

    public function handle(): int
    {
        if ($this->option('user-id')) {
            return $this->syncSingleUser($this->option('user-id'));
        }

        return $this->syncAllUsers();
    }

    /**
     * Synchronise un seul utilisateur
     */
    private function syncSingleUser($userId): int
    {
        $user = User::find($userId);

        if (!$user) {
            $this->error("Utilisateur #{$userId} non trouvé");
            return 1;
        }

        if (!$user->microsoft_token) {
            $this->warn("Utilisateur {$user->email} n'a pas de token Microsoft");
            return 0;
        }

        try {
            $this->info("🔄 Synchronisation Microsoft 365 pour {$user->email}...");

            $syncService = new MicrosoftSyncService($user);
            $results = $syncService->syncAll();

            $this->info("✅ Synchronisation terminée!");
            $this->table(
                ['Ressource', 'Synchronisés'],
                [
                    ['Événements Calendrier', $results['calendars']],
                    ['Documents', $results['documents']],
                    ['Réunions Teams', $results['meetings']],
                ]
            );

            if (!empty($results['errors'])) {
                $this->warn("⚠️  Erreurs détectées:");
                foreach ($results['errors'] as $error) {
                    $this->warn("  - $error");
                }
            }

            return 0;
        } catch (\Exception $e) {
            $this->error("Erreur: " . $e->getMessage());
            Log::error('Erreur sync Microsoft', ['user_id' => $userId, 'error' => $e->getMessage()]);
            return 1;
        }
    }

    /**
     * Synchronise tous les utilisateurs SSO
     */
    private function syncAllUsers(): int
    {
        $users = User::whereNotNull('microsoft_token')
            ->where('microsoft_token', '!=', '')
            ->get();

        if ($users->isEmpty()) {
            $this->info("Aucun utilisateur SSO trouvé");
            return 0;
        }

        $this->info("🔄 Synchronisation Microsoft 365 pour " . $users->count() . " utilisateur(s)...");

        $totalCalendars = 0;
        $totalDocuments = 0;
        $totalMeetings = 0;
        $errors = [];

        foreach ($users as $user) {
            try {
                $this->line("  ↳ {$user->email}");

                $syncService = new MicrosoftSyncService($user);
                $results = $syncService->syncAll();

                $totalCalendars += $results['calendars'];
                $totalDocuments += $results['documents'];
                $totalMeetings += $results['meetings'];

                if (!empty($results['errors'])) {
                    foreach ($results['errors'] as $error) {
                        $errors[] = "{$user->email}: $error";
                    }
                }

                $this->line("    ✓ Calendrier: {$results['calendars']} | Docs: {$results['documents']} | Teams: {$results['meetings']}");
            } catch (\Exception $e) {
                $this->warn("    ✗ Erreur: " . $e->getMessage());
                $errors[] = "{$user->email}: " . $e->getMessage();
            }
        }

        $this->info("\n✅ Synchronisation terminée! (Calendrier: $totalCalendars, Docs: $totalDocuments, Teams: $totalMeetings)");

        if (!empty($errors)) {
            $this->warn("\n⚠️  Erreurs détectées:");
            foreach ($errors as $error) {
                $this->warn("  - $error");
            }
        }

        return 0;
    }
}

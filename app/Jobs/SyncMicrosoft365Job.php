<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\MicrosoftSyncService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncMicrosoft365Job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 300; // 5 minutes timeout
    public $tries = 3; // Retry 3 times
    public $backoff = [10, 60, 300]; // Backoff: 10s, 60s, 5min

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Exécute le job de synchronisation
     */
    public function handle(): void
    {
        // Vérifier que l'utilisateur a toujours un token
        if (!$this->user->microsoft_token) {
            Log::info('Utilisateur sans token, skip sync', ['user_id' => $this->user->id]);
            return;
        }

        try {
            Log::info('Démarrage sync Microsoft 365', ['user_id' => $this->user->id, 'email' => $this->user->email]);

            $syncService = new MicrosoftSyncService($this->user);
            $results = $syncService->syncAll();

            Log::info('Sync Microsoft 365 réussie', [
                'user_id' => $this->user->id,
                'calendars' => $results['calendars'],
                'documents' => $results['documents'],
                'meetings' => $results['meetings'],
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur sync Microsoft 365', [
                'user_id' => $this->user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e; // Re-throw pour retry
        }
    }

    /**
     * Appelé après tous les retries échoués
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('Job SyncMicrosoft365 finalement échoué', [
            'user_id' => $this->user->id,
            'error' => $exception->getMessage()
        ]);

        // Optionnel : envoyer une notification à l'admin ou l'utilisateur
    }
}

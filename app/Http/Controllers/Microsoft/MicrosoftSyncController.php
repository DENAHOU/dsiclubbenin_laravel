<?php

namespace App\Http\Controllers\Microsoft;

use App\Http\Controllers\Controller;
use App\Services\MicrosoftSyncService;
use App\Jobs\SyncMicrosoft365Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MicrosoftSyncController extends Controller
{
    /**
     * Déclenche une synchronisation manuelle pour l'utilisateur courant
     */
    public function sync(): JsonResponse
    {
        $user = Auth::user();

        if (!$user->microsoft_token) {
            return response()->json([
                'success' => false,
                'message' => 'Aucun token Microsoft trouvé. Veuillez vous reconnecter.',
            ], 400);
        }

        try {
            Log::info('Sync manuelle déclenchée', ['user_id' => $user->id]);

            // Dispatcher le job de synchronisation (asynchrone)
            SyncMicrosoft365Job::dispatch($user);

            return response()->json([
                'success' => true,
                'message' => 'Synchronisation lancée. Les données seront mises à jour dans quelques secondes.',
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors du déclenchement de sync', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la synchronisation.',
            ], 500);
        }
    }

    /**
     * Récupère l'état de la synchronisation (dernière sync, nombre items)
     */
    public function status(): JsonResponse
    {
        $user = Auth::user();

        return response()->json([
            'has_token' => (bool) $user->microsoft_token,
            'token_expires_at' => $user->microsoft_token_expires_at,
            'calendars_count' => $user->microsoftCalendars()->count(),
            'documents_count' => $user->microsoftDocuments()->count(),
            'meetings_count' => $user->microsoftMeetings()->count(),
            'last_calendar_sync' => $user->microsoftCalendars()->latest('synced_at')->first()?->synced_at,
            'last_document_sync' => $user->microsoftDocuments()->latest('synced_at')->first()?->synced_at,
            'last_meeting_sync' => $user->microsoftMeetings()->latest('synced_at')->first()?->synced_at,
        ]);
    }
}

<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class MicrosoftGraphService
{
    private string $baseUrl = 'https://graph.microsoft.com/v1.0';
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Vérifie et renouvelle le token s'il a expiré
     */
    private function ensureValidToken(): string
    {
        // Si le token expire dans moins de 5 minutes, le renouveler
        if ($this->user->microsoft_token_expires_at && $this->user->microsoft_token_expires_at->lessThanOrEqualTo(now()->addMinutes(5))) {
            Log::info('Token Microsoft expirant bientôt, renouvellement...', ['user_id' => $this->user->id]);
            $this->refreshToken();
        }

        return $this->decryptToken($this->user->microsoft_token);
    }

    /**
     * Renouvelle le token Microsoft via Azure
     */
    private function refreshToken(): void
    {
        if (!$this->user->microsoft_refresh_token) {
            Log::error('Pas de refresh token disponible', ['user_id' => $this->user->id]);
            return;
        }

        try {
            $refreshToken = $this->decryptToken($this->user->microsoft_refresh_token);

            $response = Http::asForm()->post('https://login.microsoftonline.com/common/oauth2/v2.0/token', [
                'client_id' => config('services.microsoft.client_id'),
                'client_secret' => config('services.microsoft.client_secret'),
                'refresh_token' => $refreshToken,
                'grant_type' => 'refresh_token',
                'scope' => 'Calendars.Read Files.Read.All Team.ReadBasic.All Mail.Read openid profile email offline_access',
            ]);

            if ($response->failed()) {
                Log::error('Erreur lors du refresh token', [
                    'user_id' => $this->user->id,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return;
            }

            $data = $response->json();

            // Mise à jour du token
            $this->user->microsoft_token = $this->encryptToken($data['access_token']);
            $this->user->microsoft_refresh_token = $this->encryptToken($data['refresh_token'] ?? $refreshToken);
            $this->user->microsoft_token_expires_at = now()->addSeconds($data['expires_in'] ?? 3600);
            $this->user->save();

            Log::info('Token Microsoft renouvelé avec succès', ['user_id' => $this->user->id]);
        } catch (\Exception $e) {
            Log::error('Exception lors du refresh token', [
                'user_id' => $this->user->id,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Chiffre un token pour stockage sécurisé
     */
    private function encryptToken(string $token): string
    {
        return Crypt::encryptString($token);
    }

    /**
     * Déchiffre un token stocké
     */
    private function decryptToken(string $encryptedToken): string
    {
        try {
            return Crypt::decryptString($encryptedToken);
        } catch (\Exception $e) {
            Log::error('Erreur déchiffrement token', ['user_id' => $this->user->id, 'error' => $e->getMessage()]);
            return '';
        }
    }

    /**
     * 📅 Récupère les événements du calendrier
     */
    public function getCalendarEvents($limit = 10): array
    {
        try {
            $token = $this->ensureValidToken();

            $response = Http::withToken($token)
                ->timeout(10)
                ->get("{$this->baseUrl}/me/events", [
                    '$top' => $limit,
                    '$orderby' => 'start/dateTime DESC',
                    '$select' => 'id,subject,start,end,organizer,attendees,isReminderOn,reminderMinutesBeforeStart'
                ]);

            if ($response->failed()) {
                Log::error('Erreur lors de la récupération des événements Calendar', [
                    'user_id' => $this->user->id,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return [];
            }

            $events = $response->json('value', []);
            Log::info('Événements Calendar récupérés', ['user_id' => $this->user->id, 'count' => count($events)]);

            return $events;
        } catch (\Exception $e) {
            Log::error('Exception lors de getCalendarEvents', [
                'user_id' => $this->user->id,
                'message' => $e->getMessage()
            ]);
            return [];
        }
    }

    /**
     * 📄 Récupère les documents OneDrive/SharePoint
     */
    public function getSharePointDocuments($limit = 20): array
    {
        try {
            $token = $this->ensureValidToken();

            // Récupère les fichiers du répertoire racine
            $response = Http::withToken($token)
                ->timeout(10)
                ->get("{$this->baseUrl}/me/drive/root/children", [
                    '$top' => $limit,
                    '$select' => 'id,name,size,createdDateTime,lastModifiedDateTime,webUrl,folder,file'
                ]);

            if ($response->failed()) {
                Log::error('Erreur lors de la récupération des documents SharePoint', [
                    'user_id' => $this->user->id,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return [];
            }

            $documents = $response->json('value', []);
            Log::info('Documents SharePoint récupérés', ['user_id' => $this->user->id, 'count' => count($documents)]);

            return $documents;
        } catch (\Exception $e) {
            Log::error('Exception lors de getSharePointDocuments', [
                'user_id' => $this->user->id,
                'message' => $e->getMessage()
            ]);
            return [];
        }
    }

    /**
     * 👥 Récupère les réunions Teams
     */
    public function getTeamsMeetings($limit = 10): array
    {
        try {
            $token = $this->ensureValidToken();

            // Récupère les réunions en ligne (Teams meetings)
            $response = Http::withToken($token)
                ->timeout(10)
                ->get("{$this->baseUrl}/me/onlineMeetings", [
                    '$top' => $limit,
                    '$orderby' => 'createdDateTime DESC',
                    '$select' => 'id,subject,createdDateTime,startDateTime,endDateTime,joinWebUrl,participants'
                ]);

            if ($response->failed()) {
                // Si Teams/onlineMeetings n'est pas accessible, essayer calendar avec teams events
                Log::warning('onlineMeetings non accessible, fallback à calendar', [
                    'user_id' => $this->user->id,
                    'status' => $response->status()
                ]);
                return $this->getTeamsEventsFromCalendar($limit);
            }

            $meetings = $response->json('value', []);
            Log::info('Réunions Teams récupérées', ['user_id' => $this->user->id, 'count' => count($meetings)]);

            return $meetings;
        } catch (\Exception $e) {
            Log::error('Exception lors de getTeamsMeetings', [
                'user_id' => $this->user->id,
                'message' => $e->getMessage()
            ]);
            return [];
        }
    }

    /**
     * Fallback : récupère les événements Teams depuis le calendrier
     */
    private function getTeamsEventsFromCalendar($limit = 10): array
    {
        try {
            $token = $this->ensureValidToken();

            // Filtre pour récupérer uniquement les événements "isReminderOn" ou avec organizer de type Teams
            $response = Http::withToken($token)
                ->timeout(10)
                ->get("{$this->baseUrl}/me/events", [
                    '$top' => $limit,
                    '$filter' => "isOnlineMeeting eq true",
                    '$select' => 'id,subject,start,end,onlineMeetingUrl,onlineMeetingProvider'
                ]);

            if ($response->failed()) {
                return [];
            }

            return $response->json('value', []);
        } catch (\Exception $e) {
            Log::error('Exception lors de getTeamsEventsFromCalendar', [
                'user_id' => $this->user->id,
                'message' => $e->getMessage()
            ]);
            return [];
        }
    }

    /**
     * 📧 Récupère les mails non lus
     */
    public function getUnreadMails($limit = 10): array
    {
        try {
            $token = $this->ensureValidToken();

            $response = Http::withToken($token)
                ->timeout(10)
                ->get("{$this->baseUrl}/me/mailFolders/inbox/messages", [
                    '$top' => $limit,
                    '$filter' => "isRead eq false",
                    '$orderby' => 'receivedDateTime DESC',
                    '$select' => 'id,subject,from,receivedDateTime,isRead,webLink'
                ]);

            if ($response->failed()) {
                Log::error('Erreur lors de la récupération des mails', [
                    'user_id' => $this->user->id,
                    'status' => $response->status()
                ]);
                return [];
            }

            $mails = $response->json('value', []);
            Log::info('Mails récupérés', ['user_id' => $this->user->id, 'count' => count($mails)]);

            return $mails;
        } catch (\Exception $e) {
            Log::error('Exception lors de getUnreadMails', [
                'user_id' => $this->user->id,
                'message' => $e->getMessage()
            ]);
            return [];
        }
    }
}

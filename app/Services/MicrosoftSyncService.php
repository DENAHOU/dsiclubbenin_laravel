<?php

namespace App\Services;

use App\Models\User;
use App\Models\MicrosoftCalendar;
use App\Models\MicrosoftDocument;
use App\Models\MicrosoftMeeting;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class MicrosoftSyncService
{
    private MicrosoftGraphService $graphService;
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->graphService = new MicrosoftGraphService($user);
    }

    /**
     * Synchronise tous les données Microsoft 365
     */
    public function syncAll(): array
    {
        $results = [
            'calendars' => 0,
            'documents' => 0,
            'meetings' => 0,
            'errors' => [],
        ];

        try {
            $results['calendars'] = $this->syncCalendars();
            Log::info("Synchronisé {$results['calendars']} événements calendrier", ['user_id' => $this->user->id]);
        } catch (\Exception $e) {
            $results['errors'][] = "Calendrier: " . $e->getMessage();
            Log::error("Erreur sync calendrier", ['user_id' => $this->user->id, 'error' => $e->getMessage()]);
        }

        try {
            $results['documents'] = $this->syncDocuments();
            Log::info("Synchronisé {$results['documents']} documents", ['user_id' => $this->user->id]);
        } catch (\Exception $e) {
            $results['errors'][] = "Documents: " . $e->getMessage();
            Log::error("Erreur sync documents", ['user_id' => $this->user->id, 'error' => $e->getMessage()]);
        }

        try {
            $results['meetings'] = $this->syncMeetings();
            Log::info("Synchronisé {$results['meetings']} réunions", ['user_id' => $this->user->id]);
        } catch (\Exception $e) {
            $results['errors'][] = "Réunions: " . $e->getMessage();
            Log::error("Erreur sync réunions", ['user_id' => $this->user->id, 'error' => $e->getMessage()]);
        }

        return $results;
    }

    /**
     * 📅 Synchronise les événements du calendrier
     */
    public function syncCalendars(): int
    {
        $events = $this->graphService->getCalendarEvents(limit: 50);

        if (empty($events)) {
            return 0;
        }

        $synced = 0;

        foreach ($events as $event) {
            try {
                $data = [
                    'user_id' => $this->user->id,
                    'microsoft_event_id' => $event['id'],
                    'subject' => $event['subject'] ?? 'Sans titre',
                    'description' => $event['bodyPreview'] ?? null,
                    'start_time' => $this->parseDateTime($event['start'] ?? null),
                    'end_time' => $this->parseDateTime($event['end'] ?? null),
                    'organizer_name' => $event['organizer']['emailAddress']['name'] ?? null,
                    'organizer_email' => $event['organizer']['emailAddress']['address'] ?? null,
                    'attendees' => $this->extractAttendees($event['attendees'] ?? []),
                    'is_reminder_on' => $event['isReminderOn'] ?? true,
                    'reminder_minutes' => $event['reminderMinutesBeforeStart'] ?? 15,
                    'web_url' => $event['webLink'] ?? null,
                    'synced_at' => now(),
                ];

                // Upsert (update or create)
                MicrosoftCalendar::updateOrCreate(
                    ['user_id' => $this->user->id, 'microsoft_event_id' => $event['id']],
                    $data
                );

                $synced++;
            } catch (\Exception $e) {
                Log::warning("Erreur sync événement", ['event_id' => $event['id'] ?? 'unknown', 'error' => $e->getMessage()]);
            }
        }

        return $synced;
    }

    /**
     * 📄 Synchronise les documents SharePoint/OneDrive
     */
    public function syncDocuments(): int
    {
        $documents = $this->graphService->getSharePointDocuments(limit: 100);

        if (empty($documents)) {
            return 0;
        }

        $synced = 0;

        foreach ($documents as $doc) {
            try {
                $data = [
                    'user_id' => $this->user->id,
                    'microsoft_item_id' => $doc['id'],
                    'name' => $doc['name'] ?? '(Sans nom)',
                    'description' => $doc['description'] ?? null,
                    'type' => isset($doc['folder']) ? 'folder' : 'file',
                    'mime_type' => $doc['file']['mimeType'] ?? null,
                    'size' => $doc['size'] ?? 0,
                    'created_date' => $this->parseDateTime($doc['createdDateTime'] ?? null),
                    'modified_date' => $this->parseDateTime($doc['lastModifiedDateTime'] ?? null),
                    'created_by_name' => $doc['createdBy']['user']['displayName'] ?? null,
                    'created_by_email' => $doc['createdBy']['user']['mail'] ?? null,
                    'modified_by_name' => $doc['lastModifiedBy']['user']['displayName'] ?? null,
                    'modified_by_email' => $doc['lastModifiedBy']['user']['mail'] ?? null,
                    'web_url' => $doc['webUrl'] ?? null,
                    'sharing_scope' => $this->getSharingScope($doc),
                    'shared_with' => $this->extractSharedWith($doc),
                    'synced_at' => now(),
                ];

                MicrosoftDocument::updateOrCreate(
                    ['user_id' => $this->user->id, 'microsoft_item_id' => $doc['id']],
                    $data
                );

                $synced++;
            } catch (\Exception $e) {
                Log::warning("Erreur sync document", ['doc_id' => $doc['id'] ?? 'unknown', 'error' => $e->getMessage()]);
            }
        }

        return $synced;
    }

    /**
     * 👥 Synchronise les réunions Teams
     */
    public function syncMeetings(): int
    {
        $meetings = $this->graphService->getTeamsMeetings(limit: 50);

        if (empty($meetings)) {
            return 0;
        }

        $synced = 0;

        foreach ($meetings as $meeting) {
            try {
                // Pour les onlineMeetings
                if (isset($meeting['id'])) {
                    $meetingId = $meeting['id'];
                    $startTime = $this->parseDateTime($meeting['startDateTime'] ?? null);
                    $endTime = $this->parseDateTime($meeting['endDateTime'] ?? null);
                } else {
                    // Pour les calendar events avec Teams
                    $meetingId = $meeting['id'];
                    $startTime = $this->parseDateTime($meeting['start']['dateTime'] ?? null);
                    $endTime = $this->parseDateTime($meeting['end']['dateTime'] ?? null);
                }

                $data = [
                    'user_id' => $this->user->id,
                    'microsoft_meeting_id' => $meetingId,
                    'subject' => $meeting['subject'] ?? 'Sans titre',
                    'description' => $meeting['bodyPreview'] ?? null,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'organizer_name' => $meeting['organizer']['emailAddress']['name'] ?? null,
                    'organizer_email' => $meeting['organizer']['emailAddress']['address'] ?? null,
                    'participants' => $this->extractAttendees($meeting['attendees'] ?? []),
                    'participant_count' => count($meeting['attendees'] ?? []) + 1,
                    'join_url' => $meeting['onlineMeetingUrl'] ?? $meeting['joinWebUrl'] ?? null,
                    'provider' => $meeting['onlineMeetingProvider'] ?? 'teamsForBusiness',
                    'web_url' => $meeting['webLink'] ?? null,
                    'status' => now() < $startTime ? 'scheduled' : (now() > $endTime ? 'ended' : 'ongoing'),
                    'synced_at' => now(),
                ];

                MicrosoftMeeting::updateOrCreate(
                    ['user_id' => $this->user->id, 'microsoft_meeting_id' => $meetingId],
                    $data
                );

                $synced++;
            } catch (\Exception $e) {
                Log::warning("Erreur sync réunion", ['meeting_id' => $meeting['id'] ?? 'unknown', 'error' => $e->getMessage()]);
            }
        }

        return $synced;
    }

    /**
     * Parse une date Microsoft au format Laravel datetime
     */
    private function parseDateTime($dateData): ?Carbon
    {
        if (!$dateData) {
            return null;
        }

        try {
            // Format Microsoft: "2026-02-24T14:30:00.0000000"
            if (is_array($dateData)) {
                // Cas calendar event avec timeZone
                return Carbon::parse($dateData['dateTime'] ?? $dateData);
            } else {
                // String format
                return Carbon::parse($dateData);
            }
        } catch (\Exception $e) {
            Log::warning("Erreur parse datetime", ['data' => $dateData, 'error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Extrait les attendus/participants
     */
    private function extractAttendees(array $attendees): array
    {
        return array_map(function ($attendee) {
            return [
                'name' => $attendee['emailAddress']['name'] ?? null,
                'email' => $attendee['emailAddress']['address'] ?? null,
                'status' => $attendee['status']['response'] ?? 'unknown',
            ];
        }, $attendees);
    }

    /**
     * Détermine le scope de partage
     */
    private function getSharingScope($doc): ?string
    {
        if (isset($doc['shared']) && $doc['shared']) {
            // Analyser les permissions pour déterminer le scope
            return 'organization'; // Par défaut partagé au niveau organisation
        }

        return null;
    }

    /**
     * Extrait les personnes avec qui le document est partagé
     */
    private function extractSharedWith($doc): array
    {
        // À implémenter selon la structure Microsoft
        return [];
    }
}

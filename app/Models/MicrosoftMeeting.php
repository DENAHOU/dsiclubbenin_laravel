<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MicrosoftMeeting extends Model
{
    protected $table = 'microsoft_meetings';

    protected $fillable = [
        'user_id',
        'microsoft_meeting_id',
        'subject',
        'description',
        'start_time',
        'end_time',
        'organizer_name',
        'organizer_email',
        'participants',
        'participant_count',
        'join_url',
        'provider',
        'web_url',
        'status',
        'synced_at',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'synced_at' => 'datetime',
        'participants' => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope pour récupérer les réunions à venir
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_time', '>=', now())
            ->where('status', '!=', 'cancelled')
            ->orderBy('start_time', 'asc');
    }

    /**
     * Scope pour récupérer les réunions en cours
     */
    public function scopeOngoing($query)
    {
        return $query->where('start_time', '<=', now())
            ->where('end_time', '>=', now());
    }

    /**
     * Scope pour récupérer les réunions passées
     */
    public function scopePast($query)
    {
        return $query->where('end_time', '<', now())
            ->orderBy('end_time', 'desc');
    }

    /**
     * Vérifie si la réunion a commencé
     */
    public function hasStarted(): bool
    {
        return $this->start_time <= now();
    }

    /**
     * Vérifie si la réunion est en cours
     */
    public function isOngoing(): bool
    {
        return $this->start_time <= now() && $this->end_time >= now();
    }

    /**
     * Temps avant le début en minutes
     */
    public function getMinutesUntilStartAttribute(): int
    {
        return $this->start_time->diffInMinutes(now(), false);
    }
}

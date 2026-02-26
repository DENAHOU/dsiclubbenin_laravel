<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MicrosoftCalendar extends Model
{
    protected $table = 'microsoft_calendars';

    protected $fillable = [
        'user_id',
        'microsoft_event_id',
        'subject',
        'description',
        'start_time',
        'end_time',
        'organizer_name',
        'organizer_email',
        'attendees',
        'is_reminder_on',
        'reminder_minutes',
        'web_url',
        'synced_at',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'synced_at' => 'datetime',
        'attendees' => 'json',
        'is_reminder_on' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope pour récupérer les événements futurs
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_time', '>=', now())->orderBy('start_time', 'asc');
    }

    /**
     * Scope pour récupérer les événements passés
     */
    public function scopePast($query)
    {
        return $query->where('end_time', '<', now())->orderBy('end_time', 'desc');
    }
}

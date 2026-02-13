<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'type_event_id',
        'titre',
        'description',
        'date',
        'location',
        'image',
        'video_url',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function typeEvent()
    {
        return $this->belongsTo(TypeEvent::class, 'type_event_id');
    }
}

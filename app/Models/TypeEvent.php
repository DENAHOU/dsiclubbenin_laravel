<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeEvent extends Model
{
    protected $table = 'types_events';
    
    protected $fillable = [
        'nom',
        'description',
        'couleur',
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'type_event_id');
    }
}

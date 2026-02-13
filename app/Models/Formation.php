<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $fillable = [
        'type_formation',
        'categorie_formation_id',
        'titre',
        'description',
        'image',
        'video_url',
        'date_debut',
        'date_fin',
        'date_cloture_inscription',
        'lieu',
        'lien_formation',
        'lien_inscription_en_ligne',
        'lien_inscription_presentiel',
        'prix_en_ligne',
        'prix_presentiel',
        'status',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'date_cloture_inscription' => 'date',
        'prix_en_ligne' => 'decimal:2',
        'prix_presentiel' => 'decimal:2',
    ];

    public function categoryFormation()
    {
        return $this->belongsTo(CategoryFormation::class, 'categorie_formation_id');
    }
}

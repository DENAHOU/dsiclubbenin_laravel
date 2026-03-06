<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- A AJOUTER

class Formation extends Model
{
    use HasFactory; // <-- A AJOUTER

    protected $fillable = [
        'type_formation',
        'categorie_formation_id',
        'titre',
        'description',
        'image_path',
        'start_date',	
        'end_date',
        'location', 
        'online_url',
        'price',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime', // <-- AMÉLIORATION : utiliser datetime
        'end_date' => 'datetime',   // <-- AMÉLIORATION : utiliser datetime
        'price' => 'decimal:2',  // COMMENTAIRE : pour s'assurer que le prix est traité comme un nombre décimal avec 2 décimales
    ];

    

    /**
     * Une formation appartient à une catégorie.
     */
    public function categoryFormation()
    {
        return $this->belongsTo(CategoryFormation::class, 'categorie_formation_id');
    }

    /**
     * Une formation peut avoir plusieurs inscriptions.
     */
    public function registrations() // <-- AJOUT SUGGÉRÉ
    {
        return $this->hasMany(FormationRegistration::class);
    }
}
















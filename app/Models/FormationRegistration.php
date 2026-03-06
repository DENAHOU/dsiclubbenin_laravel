<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- A AJOUTER

class FormationRegistration extends Model
{
    use HasFactory; // <-- A AJOUTER

    // Soit vous utilisez $fillable, soit $guarded.
    // $guarded est plus simple si vous faites confiance à votre code.
    protected $guarded = [];

    /**
     * Une inscription appartient à une formation.
     */
    public function formation() // <-- AJOUT IMPORTANT
    {
        return $this->belongsTo(Formation::class);
    }
}


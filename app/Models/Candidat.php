<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Candidat extends Authenticatable
{
    use HasFactory, Notifiable;

    // Autorise le remplissage de tous les champs
    protected $guarded = [];

    // Cache le mot de passe
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Gère le cryptage du mot de passe et la conversion des champs JSON
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'skills' => 'array',
            'experiences' => 'array',
            'education' => 'array',
            'phone' => 'string',
            'linkedin_url' => 'string',
        ];
    }
}
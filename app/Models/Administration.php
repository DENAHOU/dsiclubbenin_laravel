<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administration extends Authenticatable
{
    use HasFactory, Notifiable;

    // On autorise tous les champs à être remplis
    protected $guarded = [];

    // On cache le mot de passe
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // On crypte automatiquement le mot de passe
    protected function casts(): array {
        return [
            'password' => 'hashed',
        ];
    }

    public function membershipPayments()
    {
        return $this->morphMany(
            \App\Models\MembershipPayment::class,
            'payable'
        );
    }

}

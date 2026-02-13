<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // On l'étend comme un utilisateur !
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable // On change "Model" en "Authenticatable"
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'ifu', 'address', 'phone', 'sector', 'service_category',
        'membership_type', 'turnover', 'logo_path',
        'contact_name', 'contact_position', 'contact_phone',
        'username', 'email', 'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
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


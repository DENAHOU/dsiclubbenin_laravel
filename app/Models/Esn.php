<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Esn extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'esns';

    protected $fillable = [
        'promoter_name',
        'civility',
        'company_name',
        'email',
        'professional_phone',
        'location',
        'legal_form',
        'website_url',
        'activity_domain',
        'creation_date',
        'experience_years',
        'staff_count',
        'turnover',
        'esn_type',
        'description',
        'trade_register_path',
        'logo_path',
        'password',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'creation_date' => 'date',
    ];

    public function getNameAttribute()
    {
        return $this->company_name;
    }

    public function getContactPositionAttribute()
    {
        return 'ESN Partenaire';
    }
}

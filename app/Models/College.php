<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class College extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_name',
        'logo_path',
        'slogan',
        'description',
        'website_url',
        'linkedin_url',
        'target_profiles',
        'expertise_tags',
        'main_innovation',
        'contribution_types',
        'training_needs',
        'contact_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'target_profiles' => 'array',      // Cast JSON vers array
        'contribution_types' => 'array',   // Cast JSON vers array
    ];

    /**
     * Mutateur : hash le mot de passe à la sauvegarde
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function membershipPayments()
    {
        return $this->morphMany(
            \App\Models\MembershipPayment::class,
            'payable'
        );
    }

}

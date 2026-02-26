<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [

        // --- ON AJOUTE TOUTES NOS NOUVELLES COLONNES ICI ---
        'role',
        'microsoft_id',
        'google_id', 
        'linkedin_id',
        'microsoft_token',
        'name',
        'username',
        'firstname',
        'lastname',
        'email',
        'password',
        'sexe',
        'phone',
        'birthday',
        'photo_path',
        'employer_contact',
        'type_members',
        'current_position',
        'current_employer',
        'sector',
        'sector_other',
        'category_of_service',
        'category_other',
        'area_of_expertise',
        'initial_training',
        'description',
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'microsoft_token', // On cache aussi le token par sécurité
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birthday' => 'date', // On dit à Laravel que ce champ est une date
        ];
    }

    public function cotisations()
    {
        return $this->hasMany(Cotisation::class, 'user_id', 'id');
    }

    // Si $member représente un membre et qu'il est lié à un user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // 'user_id' = clé étrangère
    }

    // ===== Relations Microsoft 365 =====
    public function microsoftCalendars()
    {
        return $this->hasMany(MicrosoftCalendar::class);
    }

    public function microsoftDocuments()
    {
        return $this->hasMany(MicrosoftDocument::class);
    }

    public function microsoftMeetings()
    {
        return $this->hasMany(MicrosoftMeeting::class);
    }


}

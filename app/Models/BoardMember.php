<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class BoardMember extends Model
{
    protected $fillable = [
        'role_id',
        'user_id',
        'company_id',
        'administration_id',
        'college_id',
        'start_date',
        'end_date',
        'status',
        'speech'
    ];

    /* =====================
        RELATION ROLE
    ======================*/
    public function role()
    {
        return $this->belongsTo(BoardRole::class);
    }

    /* =====================
        MEMBRE POLYMORPHE
    ======================*/
    public function member()
    {
        return $this->user
            ?? $this->company
            ?? $this->administration
            ?? $this->college;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function administration()
    {
        return $this->belongsTo(Administration::class);
    }

    public function college()
    {
        return $this->belongsTo(College::class);
    }

    /* =====================
        HELPERS POUR LES VUES
    ======================*/
    public function memberName()
    {
        $m = $this->member();

        if (!$m) return '—';

        return $m->name
            ?? $m->company_name
            ?? '—';
    }

    public function memberEmail()
    {
        return $this->member()->email ?? '—';
    }

    public function memberPhoto()
    {
        $m = $this->member();

        if ($m && isset($m->photo_path)) {
            return asset('storage/' . $m->photo_path);
        }

        return asset('images/default-avatar.png');
    }

    public function memberType()
    {
        if ($this->user_id) return 'Membre individuel';
        if ($this->company_id) return 'Entité utilisatrice';
        if ($this->administration_id) return 'Administration publique';
        if ($this->college_id) return 'Collège IT';

        return '—';
    }


    public function photo()
    {
        
        if (!$this->user) {
            return asset('images/default-user.png');
        }

        $firstname = Str::slug($this->user->firstname);
        $lastname  = Str::slug($this->user->lastname);

        $possibleNames = [
            "{$firstname}-{$lastname}",
            "{$lastname}-{$firstname}",
            $firstname,
            $lastname,
        ];

        $extensions = ['jpg','jpeg','png'];

        foreach ($possibleNames as $name) {

            foreach ($extensions as $ext) {

                $relative = "storage/profile/{$name}.{$ext}";
                $full = public_path($relative);

                if (file_exists($full)) {
                    return asset($relative);
                }
            }
        }

        return asset('images/default-user.png');
    }

        protected $casts = [
    'start_date' => 'date',
    'end_date' => 'date',
];
}
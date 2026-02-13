<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // <-- Importer Authenticatable


// Changer Model en Authenticatable
class Partner extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['password'];

    protected $casts = [
        'password' => 'hashed',
        'is_paid' => 'boolean',
    ];

    // ✅ Relation vers le type de partenaire
    public function partnerType()
    {
        return $this->belongsTo(PartnerType::class, 'partner_type_id');
    }

    // ✅ Relation vers la formule
    public function partnerFormule()
    {
        return $this->belongsTo(PartnerFormule::class, 'partner_formule_id');
    }
}





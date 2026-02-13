<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerFormule extends Model
{
    protected $guarded = [];

    protected $table = 'partner_formules';

    protected $fillable = ['name', 'amount', 'description'];

    public function partners()
    {
        return $this->hasMany(Partner::class, 'partner_formule_id');
    }
}






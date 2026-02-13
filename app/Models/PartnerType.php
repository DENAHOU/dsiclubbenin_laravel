<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerType extends Model
{
    use HasFactory;

    protected $table = 'partners_types';

    protected $fillable = ['name'];

    public function partners()
    {
        return $this->hasMany(Partner::class, 'partner_type_id');
    }
}

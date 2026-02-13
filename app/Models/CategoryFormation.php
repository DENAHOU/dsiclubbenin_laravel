<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryFormation extends Model
{
    protected $table = 'categories_formations';
    
    protected $fillable = [
        'nom',
        'description',
    ];

    public function formations()
    {
        return $this->hasMany(Formation::class, 'categorie_formation_id');
    }
}

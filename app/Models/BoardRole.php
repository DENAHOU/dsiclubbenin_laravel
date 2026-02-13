<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardRole extends Model
{
    protected $fillable = ['name'];

    public function members()
    {
        return $this->hasMany(BoardMember::class);
    }
}

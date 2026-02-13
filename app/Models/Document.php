<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'name',
        'file_path',
        'file_type',
        'file_size',
        'description',
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}

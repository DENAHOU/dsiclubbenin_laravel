<?php
// app/Models/Cotisation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    protected $fillable = [
        'user_id',
        'months',
        'amount',
        'payment_reference',
        'status',
        'invoice_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


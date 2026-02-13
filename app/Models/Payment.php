<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payable_type',
        'payable_id',
        'transaction_id',
        'amount',
        'currency',
        'payment_method',
        'status',
        'start_date',
        'end_date',
        'meta',
    ];

    /**
     * Relation polymorphe : récupère l'entité (User, Company, etc.)
     */
    public function payable()
    {
        return $this->morphTo();
    }
}

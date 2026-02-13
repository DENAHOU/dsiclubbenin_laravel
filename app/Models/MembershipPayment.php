<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPayment extends Model
{
    protected $fillable = [
        'amount',
        'period',
        'status',
        'transaction_reference',
        'invoice_path',
        'payable_id',
        'payable_type',
    ];

    public function payable()
    {
        return $this->morphTo();
    }
}

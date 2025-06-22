<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'total_price',
        'status'
    ];

    public function transactionDetails() {
        return $this->hasMany(TransactionDetail::class);
    }
}

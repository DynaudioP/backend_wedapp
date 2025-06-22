<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catering extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
    ];

    public function transactionDetails() {
        return $this->hasMany(TransactionDetail::class);
    }

    public function images()
{
    return $this->morphMany(Image::class, 'imageable');
}
}

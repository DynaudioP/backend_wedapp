<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = [
        'name',
        'location',
        'capacity',
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

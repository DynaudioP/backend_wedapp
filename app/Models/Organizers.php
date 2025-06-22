<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organizers extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description'
    ];

    public function transactionDetails() {
        return $this->hasMany(TransactionDetail::class, 'eo_id');
    }

    public function images()
{
    return $this->morphMany(Image::class, 'imageable');
}
}

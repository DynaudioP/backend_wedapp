<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transaction_id',
        'venue_id',
        'catering_id',
        'eo_id',
        'guest_count'
    ];

    public function venue() {
        return $this->belongsTo(Venue::class);
    }

    public function catering() {
        return $this->belongsTo(Catering::class);
    }

    public function organizer() {
        return $this->belongsTo(Organizers::class, 'eo_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

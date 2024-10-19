<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservedCottage extends Model
{
    use HasFactory;

    protected $fillable = [
        'cottage_id',
        'reservation_id',
        'quantity'
    ];

    public function reservations(){
        return $this->belongsTo(Reservation::class);
    }

    public function cottages(){
        return $this->belongsTo(Cottage::class);
    }
}

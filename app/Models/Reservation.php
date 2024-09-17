<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'status',
        'payment',
        'date_booked'
    ];

    public function reserved_cottages() {
        return $this->hasMany(ReservedCottage::class);
    }
}

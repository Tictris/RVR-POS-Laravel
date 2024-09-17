<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrance extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'total'
    ];

    public function booked_cottages(){
        return $this->hasMany(BookedCottage::class);
    }

    public function customers_count(){
        return $this->hasMany(CustomerCount::class);
    }
}

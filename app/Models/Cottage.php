<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cottage extends Model
{
    use HasFactory;

    protected $fillable =[
        'type',
        'price',
        'available'
    ];

    public function booked_cottages(){
        return $this->hasMany(BookedCottage::class, 'cottage_id');
    }

    public function reserved_cottages() {
        return $this->hasMany(ReservedCottage::class);
    }
}

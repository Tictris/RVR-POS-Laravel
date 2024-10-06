<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'entrance_id',
        'count'
    ];

    public function entrance(){
        return $this->belongsTo(Entrance::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}

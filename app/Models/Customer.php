<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'rate',
        'description'
    ];

    public function customers_count(){
        return $this->hasMany(CustomerCount::class);
    }

}

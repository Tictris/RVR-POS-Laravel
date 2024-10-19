<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedCottage extends Model
{
    use HasFactory;

    protected $fillable = [
        'entrance_id',
        'cottage_id',
        'quantity'
    ];

    public function entrance(){
        return $this->belongsTo(Entrance::class);
    }

    public function cottage(){
        return $this->belongsTo(Cottage::class);
    }
}

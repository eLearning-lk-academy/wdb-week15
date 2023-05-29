<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'check_in',
        'check_out',
        'total_cost',
        'notes',
        'occupants',
        'status',
    ];

    public function room(){
        return $this->belongsTo(Room::class);
    }
}

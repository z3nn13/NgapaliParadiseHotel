<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;


    //  Get Room Type of this Room.
    public function room_type()
    {
        return $this->belongsTo(RoomType::class);
    }

    //  Get Reservations to this Room.
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    //  Get all of the rooms for the reservation.
    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    //  Get room deal for this reservation.
    public function room_deal()
    {
        return $this->hasOne(RoomDeal::class, 'deal_id');
    }
}

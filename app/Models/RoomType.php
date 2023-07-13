<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{

    use HasFactory;

    // The room deals that are related to this room type
    public function room_deals()
    {
        return $this->hasMany(RoomDeal::class);
    }

    // The rooms that are related to this room type
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function available_rooms($checkin, $checkout)
    {
        // 
    }
}

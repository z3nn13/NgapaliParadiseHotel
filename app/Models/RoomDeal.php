<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomDeal extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_type_id',
        'deal_name',
        'deal_mmk',
        'is_active',
    ];


    public function getDealUsdAttribute()
    {
        return $this->deal_mmk / 2000;
    }
    // The room type this room deal belongs to
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }


    public function reservations()
    {
        return $this->belongsToMany(RoomDeal::class, 'reservation_rooms');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'reservation_rooms')
            ->withPivot('reservation_id');
    }
}

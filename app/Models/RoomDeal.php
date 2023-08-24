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


    public function deal_usd()
    {
        return $this->deal_mmk / 2000;
    }
    // The room type this room deal belongs to
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }


    public function reservation()
    {
        return $this->belongsToMany(RoomDeal::class, 'reservation_rooms');
    }
}

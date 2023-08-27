<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;

class Room extends Model
{
    use HasFactory;
    use EagerLoadPivotTrait;

    public function scopeAvailableRoomTypes($query, $checkInDate, $checkOutDate)
    {
        return $query->select('room_type_id')
            ->selectRaw('GROUP_CONCAT(id) as room_ids')
            ->whereDoesntHave('reservations', function ($subQuery) use ($checkInDate, $checkOutDate) {
                $subQuery->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                    ->whereBetween('check_out_date', [$checkInDate, $checkOutDate]);
            })
            ->groupBy('room_type_id');
    }

    //  Get Room Type of this Room.
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    //  Get Reservations to this Room.
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_rooms')
            ->withPivot("room_deal_id");
    }
}

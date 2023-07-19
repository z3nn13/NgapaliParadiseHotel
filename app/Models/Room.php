<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;


    public function scopeAvailableRoomTypes($query, $checkInDate, $checkOutDate)
    {
        $periodOfStay = [$checkInDate, $checkOutDate];

        return $query->select('room_type_id')
            ->selectRaw('GROUP_CONCAT(id) as room_ids')
            ->whereDoesntHave('reservations', function ($subQuery) use ($periodOfStay) {
                $subQuery->whereBetween('check_in_date', $periodOfStay)
                    ->orWhereBetween('check_out_date', $periodOfStay);
            })
            ->groupBy('room_type_id');
    }

    //  Get Room Type of this Room.
    public function room_type()
    {
        return $this->belongsTo(RoomType::class);
    }

    //  Get Reservations to this Room.
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservations_rooms');
    }
}

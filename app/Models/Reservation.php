<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable. 
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'deal_id',
        'num_guests',
        'check_in_date',
        'check_out_date',
        'special_request',
        'status',
    ];

    //  Get all of the rooms for the reservation.
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'reservations_rooms')->withPivot('room_deal_id');
    }

    //  Get room deal for this reservation.
    public function room_deal()
    {
        return $this->hasOne(RoomDeal::class, 'deal_id');
    }
}

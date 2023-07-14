<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'room_type_name',
        'room_image',
        'occupancy',
        'view',
        'bedding',
        'description',
        'available_rooms'
    ];


    public function highest_price()
    {
        return $this->room_deals()->max('deal_mmk');
    }

    public function lowest_price()
    {
        return $this->room_deals()->min('deal_mmk');
    }

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
}

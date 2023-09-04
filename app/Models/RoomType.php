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
        'room_type_name',
        'room_category_id',
        'room_image',
        'occupancy',
        'view',
        'bedding',
        'description',
        'available_rooms'
    ];


    /**
     * Scope function to search room types by name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $searchQuery
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchBy($query, $searchQuery)
    {
        if ($this->hasLeadingZeros($searchQuery)) {
            $trimmedQuery = ltrim($searchQuery, '0');

            if ($trimmedQuery === "") {
                return $query;
            }

            return $query->where('id', 'LIKE', '%' . $trimmedQuery  . '%');
        }

        return $query->where('room_type_name', 'LIKE', '%' . $searchQuery . '%')
            ->orWhere('id', 'LIKE', '%' . $searchQuery . '%')
            ->orWhere('occupancy', 'LIKE', '%' . $searchQuery . '%')
            ->orWhere('view', 'LIKE', '%' . $searchQuery . '%')
            ->orWhere('bedding', 'LIKE', '%' . $searchQuery . '%');
    }

    // Use a regular expression to check for leading zeros
    function hasLeadingZeros($string)
    {
        return preg_match('/^0{1,3}/', $string) === 1;
    }

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

    public function scopeBelongsToCategory($query, $categoryId)
    {
        return $query->where('room_category_id', $categoryId)->get();
    }

    // The rooms that are related to this room type
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function roomCategory()
    {
        return $this->belongsTo(RoomCategory::class, 'room_category_id');
    }

    public function getFormattedIdAttribute()
    {
        return sprintf('%03d', $this->id);
    }
}

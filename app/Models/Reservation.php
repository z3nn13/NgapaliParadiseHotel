<?php

namespace App\Models;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'num_guests',
        'check_in_date',
        'check_out_date',
        'special_request',
        'status',
        'first_name',
        'last_name',
        'country',
        'phone_no',
        'email',
    ];


    public function scopeSearchBy($query, $searchQuery)
    {
        $nameParts = explode(' ', $searchQuery);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';

        if ($this->hasLeadingZeros($searchQuery)) {
            $trimmedQuery = ltrim($searchQuery, '0');

            if ($trimmedQuery === "") {
                return $query;
            }

            return $query->where('id', 'LIKE', '%' . $trimmedQuery  . '%');
        }

        if (count($nameParts) === 2) {
            return $query->where(function ($query) use ($firstName, $lastName) {
                $query->where('first_name', 'LIKE', "%$firstName%")
                    ->Where('last_name', 'LIKE', "%$lastName%");
            });
        };;
        return $query->where(function ($query) use ($searchQuery) {
            $query->where('first_name', 'LIKE', "%$searchQuery%")
                ->orWhere('last_name', 'LIKE', "%$searchQuery%")
                ->orWhere('id', 'LIKE', "%$searchQuery%")
                ->orWhere('status', 'LIKE', "%$searchQuery%");
        });
    }

    /**
     * Get the total number of reservations created today.
     *
     * @param Builder $query
     * @return int
     */
    public function scopeTotalReservationsToday($query)
    {
        $today = date('Y-m-d');
        return $query->whereDate('created_at', $today)->count();
    }


    // Use a regular expression to check for leading zeros
    function hasLeadingZeros($string)
    {
        return preg_match('/^0{1,3}/', $string) === 1;
    }

    //  Get the user for the reservation.    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //  Get the invoice for the reservation.    
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    //  Get all of the rooms for the reservation.    

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'reservation_rooms');
    }


    public function roomDeals()
    {
        return $this->belongsToMany(RoomDeal::class, 'reservation_rooms');
    }
}

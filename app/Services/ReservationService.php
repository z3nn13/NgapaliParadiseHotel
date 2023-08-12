<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\RoomDeal;
use App\Models\RoomType;
use Illuminate\Http\Request;


/**
 * Class ReservationService
 * @package App\Services
 */

class ReservationService
{
    protected $roomHelper;

    public function __construct(RoomHelper $roomHelper)
    {
        $this->roomHelper = $roomHelper;
    }

    /**
     * Initializes the session for a new reservation
     * 
     * @param string $checkInDate
     * @param string $checkOutDate
     * @return array
     */
    public function initializeSessionData($checkInDate, $checkOutDate)
    {
        $numNights = Carbon::parse($checkInDate)->diffInDays(Carbon::parse($checkOutDate));
        session()->put([
            'numNights' => $numNights,
            'checkInDate' => $checkInDate,
            'checkOutDate' => $checkOutDate,
        ]);
    }

    /**
     * Loads the available rooms for a given date range
     * 
     * @param string $checkInDate
     * @param string $checkOutDate
     */
    public function loadAvailableRoomData($checkInDate, $checkOutDate)
    {
        $availableRoomTypes = Room::availableRoomTypes($checkInDate, $checkOutDate)
            ->with('room_type')
            ->get()
            ->map(function ($room) {
                $roomType = $room->room_type;
                $roomType->availableRoomIds = $this->roomHelper->parseAvailableRoomIds($room->room_ids);
                return $roomType;
            });

        $availableRoomIds = $availableRoomTypes->pluck('availableRoomIds', 'id')->toArray();

        return compact('availableRoomTypes', 'availableRoomIds');
    }


    /** 
     * Stores the data for a new reservation room in the session
     * 
     * @param RoomType $roomType
     * @param RoomDeal $roomDeal
     * @param array $availableRoomIds
     */
    public static function storeRoomToSession(
        RoomType $roomType,
        RoomDeal $roomDeal,
        array $availableRoomIds
    ) {
        $reservation_room = [
            'roomDeal' => $roomDeal,
            'roomType' => $roomType,
            'roomAssigned' => Room::find($availableRoomIds[0]),
        ];

        session()->push('reservation_rooms', $reservation_room);
        session()->save();
    }

    public function sortRoomTypes($roomTypes, $selectedSortOption)
    {
        if ($selectedSortOption === 'desc') {
            return $roomTypes->sortByDesc(function ($roomType) {
                return $roomType->highest_price();
            });
        } elseif ($selectedSortOption === 'asc') {
            return $roomTypes->sortBy(function ($roomType) {
                return $roomType->lowest_price();
            });
        }

        return $roomTypes;
    }
}

/**
 * Class RoomHelper
 * @package App\Services
 */
class RoomHelper
{
    public function is_additional_room(Request $request)
    {
        return $request->session()->has('reservation_rooms');
    }

    /**
     * Parses the available room ids from a given string
     * 
     * @param $roomIds
     * @return array
     */
    public function parseAvailableRoomIds($roomIds)
    {
        return $roomIds !== "" ? explode(',', $roomIds) : [];
    }
}

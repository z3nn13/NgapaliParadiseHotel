<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\RoomDeal;
use App\Models\RoomType;
use Illuminate\Support\Collection;

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
     * * Initializes the session for a new reservation
     * 
     * @param string $checkInDate
     * @param string $checkOutDate
     * @param string $numGuests
     */
    public function initializeSessionData($checkInDate, $checkOutDate, $numGuests): void
    {
        $numNights = Carbon::parse($checkOutDate)->diffInDays(Carbon::parse($checkInDate));
        session([
            'booking' => [
                'checkInDate' => $checkInDate,
                'checkOutDate' => $checkOutDate,
                'numGuests' => $numGuests,
                'numNights' => $numNights,
            ],
        ]);
    }

    /**
     * * Loads the available rooms for a given date range
     * 
     * @param string $checkInDate
     * @param string $checkOutDate
     */
    public function loadAvailableRoomData($checkInDate, $checkOutDate): Collection
    {
        $availableRoomTypes = Room::availableRoomTypes($checkInDate, $checkOutDate)
            ->with('roomType.room_deals')
            ->get()
            ->map(function ($room) {
                $roomType = $room->roomType;
                $availableRoomIds = $this->roomHelper->parseAvailableRoomIds($room->room_ids);
                return compact('roomType', 'availableRoomIds');
            });

        return $availableRoomTypes;
    }


    /** 
     * * Stores the data for a new reservation room in the session
     * 
     * @param RoomDeal $roomDeal
     * @param array $availableRoomIds
     */
    public static function storeRoomToSession(RoomDeal $roomDeal, array $availableRoomIds): void
    {
        $room = Room::with('roomType')->find($availableRoomIds[0]);
        $reservation_room = [
            'roomDeal' => $roomDeal,
            'room' => $room,
        ];

        session()->push('booking.reservation_rooms', $reservation_room);
        session()->save();
    }


    /**
     * Sort rooms according to the selected price options
     * 
     * @param   Collection    $roomTypeArrays
     * @param   string        $selectedSortOption
     * @return  Collection
     */
    public function sortRoomTypesByPrice($roomTypeArrays, string $selectedSortOption)
    {
        $sortDirections = [
            'high_to_low' => 'desc',
            'low_to_high' => 'asc',
        ];

        $selectedSortOption = $sortDirections[$selectedSortOption];

        $sortedRoomTypeArrays = $roomTypeArrays->map(function ($roomTypeArray) use ($selectedSortOption) {
            $roomType = $roomTypeArray['roomType'];

            $sortedRoomDeals = $roomType->room_deals
                ->orderBy('deal_mmk', $selectedSortOption)
                ->get();

            $roomType->setRelation('room_deals', $sortedRoomDeals);
            $roomTypeArray['roomType'] = $roomType;

            return $roomTypeArray;
        });

        $sortByMethod = ($selectedSortOption === 'desc') ? 'sortByDesc' : 'sortBy';
        $priceMethod = ($selectedSortOption === 'desc') ? 'highest_price' : 'lowest_price';

        return $sortedRoomTypeArrays->$sortByMethod(function ($roomTypeArray) use ($priceMethod) {
            return $roomTypeArray['roomType']->$priceMethod();
        });
    }
}

/**
 * * Class RoomHelper
 * @package App\Services
 */
class RoomHelper
{
    public function is_additional_room()
    {
        return session()->has('booking.reservation_rooms');
    }

    /**
     * * Parses the available room ids from a given string
     * 
     * @param $roomIds
     * @return array
     */
    public function parseAvailableRoomIds($roomIds)
    {
        return $roomIds !== "" ? explode(',', $roomIds) : [];
    }
}

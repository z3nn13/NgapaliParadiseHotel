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
        $numNights = Carbon::parse($checkInDate)->diffInDays(Carbon::parse($checkOutDate));
        session([
            'booking' => [
                'numNights' => $numNights,
                'checkInDate' => $checkInDate,
                'checkOutDate' => $checkOutDate,
                'numGuests' => $numGuests,
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
                $roomType->availableRoomIds = $this->roomHelper->parseAvailableRoomIds($room->room_ids);
                return $roomType;
            });
        return $availableRoomTypes;
    }


    /** 
     * * Stores the data for a new reservation room in the session
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

        session()->push('booking.reservation_rooms', $reservation_room);
        session()->save();
    }


    /**
     * * Sort rooms according to the selected price options
     * 
     * @param   Collection    $roomTypes
     * @param   string      $selectedSortOption
     * @return   Collection
     */
    public function sortRoomTypesByPrice($roomTypes, string $selectedSortOption)
    {
        $sortDirections = [
            'high_to_low' => 'desc',
            'low_to_high' => 'asc',
        ];
        $selectedSortOption = $sortDirections[$selectedSortOption];
        $sortedRoomTypes = $roomTypes->map(function ($roomType) use ($selectedSortOption) {
            $sortedRoomDeals = $roomType->room_deals()
                ->orderBy('deal_mmk', $selectedSortOption)
                ->get();

            $roomType->setRelation('room_deals', $sortedRoomDeals);
            return $roomType;
        });

        $sortByMethod = ($selectedSortOption === 'desc') ? 'sortByDesc' : 'sortBy';
        $priceMethod = ($selectedSortOption === 'desc') ? 'highest_price' : 'lowest_price';

        return $sortedRoomTypes->$sortByMethod(function ($roomType) use ($priceMethod) {
            return $roomType->$priceMethod();
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

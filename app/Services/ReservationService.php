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
     * Initializes the session for a new reservation
     * 
     * @param string $checkInDate
     * @param string $checkOutDate
     * @param string $numGuests
     */
    public function initializeSessionData($checkInDate, $checkOutDate, $numGuests): void
    {
        $booking = session('booking', []);

        $updatedKeys = [
            'checkInDate' => $checkInDate,
            'checkOutDate' => $checkOutDate,
            'numGuests' => $numGuests,
            'numNights' => Carbon::parse($checkOutDate)->diffInDays(Carbon::parse($checkInDate))
        ];

        $booking = array_merge($booking, $updatedKeys);

        session(['booking' => $booking]);
    }


    /**
     * Loads the available rooms for a given date range
     * 
     * @param string $checkInDate
     * @param string $checkOutDate
     * @return Collection
     */
    public function loadAvailableRoomData($checkInDate, $checkOutDate): Collection
    {
        return Room::availableRoomTypes($checkInDate, $checkOutDate)
            ->with('roomType.room_deals')
            ->get()
            ->map(function ($room) {
                $availableRoomIds = $this->roomHelper->parseAvailableRoomIds($room->room_ids);
                $reservedRoomIds = $this->getReservedRoomIdsFromSession();

                $filteredRoomIds = array_diff($availableRoomIds, $reservedRoomIds);

                return [
                    'roomType' => $room->roomType,
                    'availableRoomIds' => $filteredRoomIds,
                ];
            })
            ->filter(function ($roomData) {
                return !empty($roomData['availableRoomIds']);
            });
    }

    /**
     * Get reserved room IDs from session
     */
    private function getReservedRoomIdsFromSession(): array
    {
        $reservationRooms = session('booking.reservation_rooms', []);
        $reservedRoomIds = array_map(function ($reservationRoom) {
            return $reservationRoom['room'] ? $reservationRoom['room']->id : null;
        }, $reservationRooms);

        return $reservedRoomIds;
    }

    /** 
     * * Stores the data for a new reservation room in the session
     * 
     * @param RoomDeal $roomDeal
     * @param array $availableRoomIds
     */
    public static function storeRoomToSession(RoomDeal $roomDeal, array $availableRoomIds): void
    {
        $room = Room::with('roomType')->find(reset($availableRoomIds));
        $reservationRoom = [
            'roomDeal' => $roomDeal,
            'room' => $room,
        ];

        session()->push('booking.reservation_rooms', $reservationRoom);
        session()->save();
    }

    /**
     * * Removes a room from the reservation rooms in the session.
     *
     * @param Room $room
     */
    public static function destroyRoomFromSession(Room $room): void
    {
        $reservationRooms = session('booking.reservation_rooms', []);

        $updatedReservationRooms = array_filter($reservationRooms, function ($reservationRoom) use ($room) {
            return $reservationRoom['room']->id !== $room->id;
        });

        session(['booking.reservation_rooms' => $updatedReservationRooms]);
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

        $selectedSortDirection = $sortDirections[$selectedSortOption];

        $sortedRoomTypeArrays = $roomTypeArrays->map(function ($roomTypeArray) use ($selectedSortDirection) {
            return $this->sortRoomDeals($roomTypeArray, $selectedSortDirection);
        });

        $sortByMethod = ($selectedSortDirection === 'desc') ? 'sortByDesc' : 'sortBy';
        $priceMethod = ($selectedSortDirection === 'desc') ? 'highest_price' : 'lowest_price';

        return $sortedRoomTypeArrays->$sortByMethod(function ($roomTypeArray) use ($priceMethod) {
            return $roomTypeArray['roomType']->$priceMethod();
        });
    }

    private function sortRoomDeals(array $roomTypeArray, string $selectedSortDirection): array
    {
        $roomType = $roomTypeArray['roomType'];

        $sortedRoomDeals = $roomType->room_deals->sortBy('deal_mmk', SORT_REGULAR, $selectedSortDirection === 'desc');

        $roomType->room_deals = $sortedRoomDeals;
        $roomTypeArray['roomType'] = $roomType;

        return $roomTypeArray;
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

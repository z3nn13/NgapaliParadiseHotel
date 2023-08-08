<?php

namespace App\Http\Livewire;

use App\Models\Room;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Http\Request;

class ReservationSearch extends Component
{
    public $availableRoomTypes;
    public $availableRoomIds;

    protected $listeners = ['option_selected' => 'sort_room_types'];

    public function mount(Request $request)
    {
        $checkInDate = $request->input('checkInDate');
        $checkOutDate = $request->input('checkOutDate');
        $this->storeDataToSession($checkInDate, $checkOutDate);
        $this->availableRoomTypes = $this->getAvailableRooms($checkInDate, $checkOutDate);
        $this->availableRoomIds = $this->availableRoomTypes->pluck('availableRoomIds', 'id')->toArray();
    }

    public function render()
    {
        return view('livewire.reservation-search')
            ->extends('booking.search')
            ->section('room-list');
    }


    public function storeDataToSession($checkInDate, $checkOutDate)
    {
        $numNights = Carbon::parse($checkInDate)->diffInDays(Carbon::parse($checkOutDate));
        session()->put('numNights', $numNights);
        session()->put('checkInDate', $checkInDate);
        session()->put('checkOutDate', $checkOutDate);
    }

    public function is_additional_room(Request $request)
    {
        return $request->session()->has('reservation_rooms');
    }

    public function getAvailableRooms($checkInDate, $checkOutDate)
    {
        $availableRooms = Room::availableRoomTypes($checkInDate, $checkOutDate)
            ->with('room_type')
            ->get();
        return $availableRooms->map(function ($room) {
            $roomType = $room->room_type;
            if ($room->room_ids !== "") {
                $roomType->availableRoomIds = explode(',', $room->room_ids);
            } else {
                $roomType->availableRoomIds = [];
            };
            return $roomType;
        });
    }



    public function sort_room_types($selectedSortOption)
    {
        $roomTypes = $this->availableRoomTypes;


        if ($selectedSortOption === 'desc') {
            $sortedRoomTypes = $roomTypes->sortByDesc(function ($roomType) {
                return $roomType->highest_price();
            });
        } else if ($selectedSortOption === 'asc') {
            $sortedRoomTypes = $roomTypes->sortBy(function ($roomType) {
                return $roomType->lowest_price();
            });
        }
        // Restore the available room ids to each room type
        $this->availableRoomTypes = $sortedRoomTypes->map(function ($roomType) {
            $roomType->availableRoomIds = $this->availableRoomIds[$roomType->id];
            return $roomType;
        });
    }
}

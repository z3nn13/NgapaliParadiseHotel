<?php

namespace App\Http\Livewire;

use App\Models\Room;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Http\Request;

class ReservationSearch extends Component
{
    public $availableRoomTypes;
    public $availableRoomIds; // Separate property to retain the availableRoomIds

    protected $listeners = ['optionSelected' => 'sortRoomTypes'];

    public function mount(Request $request)
    {
        $checkInDate = $request->input('checkInDate');
        $checkOutDate = $request->input('checkOutDate');
        $numNights = Carbon::parse($checkInDate)->diffInDays(Carbon::parse($checkOutDate));
        $request->session()->put($request->query());
        $request->session()->put('numNights', $numNights);
        $count = rand(1, 5);
        $availableRooms = Room::availableRoomTypes($checkInDate, $checkOutDate)
            ->with('room_type')
            ->get();

        $availableRoomTypes = $availableRooms->map(function ($room) {
            $roomType = $room->room_type;
            $roomType->availableRoomIds = $room->room_ids;
            return $roomType;
        });

        // Store the available room ids in the separate property
        $this->availableRoomIds = $availableRoomTypes->pluck('availableRoomIds', 'id')->toArray();
        $this->availableRoomTypes = $availableRoomTypes;
    }

    public function sortRoomTypes($selectedSortOption)
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

    public function render()
    {
        return view('livewire.reservation-search')
            ->extends('booking.search')
            ->section('room-list');
    }
}

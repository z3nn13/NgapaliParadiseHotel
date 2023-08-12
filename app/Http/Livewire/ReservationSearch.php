<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Room;
use Livewire\Component;
use App\Models\RoomDeal;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Services\ReservationService;

class ReservationSearch extends Component
{
    public $availableRoomTypes;
    public $availableRoomIds;

    protected $listeners = ['option_selected' => 'sortRoomTypes'];

    public function mount(Request $request, ReservationService $reservationService)
    {
        $checkInDate = $request->input('checkInDate');
        $checkOutDate = $request->input('checkOutDate');
        $reservationService->initializeSessionData($checkInDate, $checkOutDate);
        $this->loadAvailableRoomData($checkInDate, $checkOutDate, $reservationService);
    }


    public function render()
    {
        return view('livewire.reservation-search')
            ->extends('booking.search')
            ->section('room-list');
    }

    private function loadAvailableRoomData($checkInDate, $checkOutDate, ReservationService $reservationService)
    {
        $data = $reservationService->loadAvailableRoomData($checkInDate, $checkOutDate);
        $this->availableRoomTypes = $data['availableRoomTypes'];
        $this->availableRoomIds = $data['availableRoomIds'];
    }


    public function bookRoom(RoomType $roomType, RoomDeal $roomDeal, array $availableRoomIds, ReservationService $reservationService)
    {
        $reservationService->storeRoomToSession($roomType, $roomDeal, $availableRoomIds);
        return redirect()->route('booking.create');
    }

    public function sortRoomTypes($selectedSortOption, ReservationService $reservationService)
    {
        $this->availableRoomTypes = $reservationService->sortRoomTypes($this->availableRoomTypes, $selectedSortOption);
    }
}

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

    protected $reservationService;

    public function boot(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function mount(Request $request)
    {
        $checkInDate = $request->input('checkInDate');
        $checkOutDate = $request->input('checkOutDate');
        $this->reservationService->initializeSessionData($request);
        $this->loadAvailableRoomData($checkInDate, $checkOutDate);
    }


    public function render()
    {
        return view('livewire.reservation-search')
            ->extends('booking.search')
            ->section('room-list');
    }

    private function loadAvailableRoomData($checkInDate, $checkOutDate)
    {
        $data = $this->reservationService->loadAvailableRoomData($checkInDate, $checkOutDate);
        $this->availableRoomTypes = $data['availableRoomTypes'];
        $this->availableRoomIds = $data['availableRoomIds'];
    }


    public function bookRoom(RoomType $roomType, RoomDeal $roomDeal, array $availableRoomIds)
    {
        $this->reservationService->storeRoomToSession($roomType, $roomDeal, $availableRoomIds);
        return redirect()->route('booking.create');
    }

    public function sortRoomTypes($selectedSortOption)
    {
        $this->availableRoomTypes = $this->reservationService->sortRoomTypes($this->availableRoomTypes, $selectedSortOption);
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RoomDeal;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Services\ReservationService;

class ReservationSearch extends Component
{
    protected $listeners = ['optionSelected' => 'sortByPrice'];
    protected $reservationService;

    public $checkInDate;
    public $checkOutDate;
    public $numGuests;

    protected $queryString = [
        'checkInDate' => ['as' => 'checkIn'],
        'checkOutDate' => ['as' => 'checkOut'],
        'numGuests',
    ];


    public function boot(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function mount()
    {
        $this->checkInDate =  request()->query('checkIn', session('booking.checkInDate'));
        $this->checkOutDate = request()->query('checkOut', session('booking.checkOutDate'));
        $this->numGuests = request()->query('numGuests', session('booking.numGuests'));

        $this->checkValidDates($this->checkInDate, $this->checkOutDate);
        $this->checkValidNumGuests($this->numGuests);
    }


    public function render()
    {
        return view('livewire.reservation-search')->layout('layouts.app');
    }


    public function sortByPrice($selectedSortOption)
    {
        $this->availableRoomTypes = $this->reservationService->sortRoomTypesByPrice($this->availableRoomTypes, $selectedSortOption);
    }


    public function getAvailableRoomTypesProperty()
    {
        $checkInDate = session('booking.checkInDate');
        $checkOutDate = session('booking.checkOutDate');
        return $this->reservationService->loadAvailableRoomData($checkInDate, $checkOutDate);
    }


    public function bookRoom(RoomType $roomType, RoomDeal $roomDeal, array $availableRoomIds)
    {
        $this->reservationService->storeRoomToSession($roomType, $roomDeal, $availableRoomIds);
        return redirect()->route('booking.create');
    }


    private function checkValidDates($checkInDate, $checkOutDate)
    {
        if ($checkInDate < $checkOutDate) {
            return;
        }
        abort(400, 'Invalid date range. Please select valid dates.');
    }

    private function checkValidNumGuests($numGuests)
    {
        if (1 <= $numGuests && $numGuests <= 10) {
            return;
        }
        abort(400, 'No. of guests must be between 1 and 10.');
    }
}

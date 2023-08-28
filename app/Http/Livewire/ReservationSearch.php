<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
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
        'checkInDate',
        'checkOutDate',
        'numGuests',
    ];

    public $availableRoomData;

    public function boot(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function mount()
    {
        $this->checkInDate =  request()->query('checkInDate', session('booking.checkInDate'));
        $this->checkOutDate = request()->query('checkOutDate', session('booking.checkOutDate'));
        $this->numGuests = request()->query('numGuests', session('booking.numGuests'));

        $this->checkValidDates($this->checkInDate, $this->checkOutDate);
        $this->checkValidNumGuests($this->numGuests);
        $this->reservationService->initializeSessionData($this->checkInDate, $this->checkOutDate, $this->numGuests);
        $this->setAvailableRoomData($this->checkInDate, $this->checkOutDate);
    }


    public function render()
    {
        return view('livewire.reservation-search')->layout('layouts.app');
    }


    public function hydrate()
    {

        $this->availableRoomData = $this->availableRoomData->map(function ($item) {
            $roomDeals = RoomDeal::make($item['roomType']['room_deals']);
            $item['roomType'] = RoomType::make($item['roomType']);
            $item['roomType']->setRelation('room_deals', $roomDeals);
            return $item;
        });
    }

    public function sortByPrice($selectedSortOption)
    {
        $this->availableRoomData = $this->reservationService->sortRoomTypesByPrice($this->availableRoomData, $selectedSortOption);
    }


    public function setAvailableRoomData()
    {
        $this->availableRoomData =  $this->reservationService->loadAvailableRoomData($this->checkInDate, $this->checkOutDate);
    }


    public function bookRoom(RoomDeal $roomDeal, array $availableRoomIds)
    {
        $this->reservationService->storeRoomToSession($roomDeal, $availableRoomIds);
        return redirect()->route('booking.create');
    }


    private function checkValidDates($checkInDate, $checkOutDate)
    {
        if ($checkInDate < $checkOutDate) {
            return;
        }
        abort(400, 'Invalid date range. Please make sure the check-out date is at least 1 day after the check-in date.');
    }

    private function checkValidNumGuests($numGuests)
    {
        if (1 <= $numGuests && $numGuests <= 10) {
            return;
        }
        abort(400, 'No. of guests must be between 1 and 10.');
    }
}

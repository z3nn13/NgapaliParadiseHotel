<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RoomDeal;
use App\Models\RoomType;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use App\Services\ReservationService;
use Illuminate\Pagination\LengthAwarePaginator;

class ReservationSearch extends Component
{
    use WithPagination;

    public $checkInDate;
    public $checkOutDate;
    public $numGuests;
    public $availableRoomData;
    public $items_per_page = 4;


    protected $listeners = ['optionSelected' => 'sortByPrice'];
    protected $reservationService;
    protected $queryString = [
        'checkInDate',
        'checkOutDate',
        'numGuests',
    ];


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
        $this->loadAvailableRoomData($this->checkInDate, $this->checkOutDate);
    }


    public function render()
    {
        $paginatedData = $this->paginate($this->availableRoomData, $this->items_per_page);

        return view('livewire.reservation-search', [
            'paginatedData' => $paginatedData
        ])->layout('layouts.app');
    }


    private function paginate(Collection $items, int $perPage = 6): LengthAwarePaginator
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemsForCurrentPage = $items->forPage($currentPage, $perPage);
        return new LengthAwarePaginator(
            $itemsForCurrentPage,
            count($items),
            $perPage,
            $currentPage,
            array('path' => LengthAwarePaginator::resolveCurrentPath())
        );
    }


    public function hydrate()
    {
        $this->availableRoomData = $this->availableRoomData->map(function ($item) {
            $item['roomType'] = RoomType::with('room_deals')->find($item['roomType']['id']);
            return $item;
        });
    }

    public function sortByPrice($selectedSortOption)
    {
        $this->availableRoomData = $this->reservationService->sortRoomTypesByPrice($this->availableRoomData, $selectedSortOption);
    }


    public function loadAvailableRoomData()
    {
        $this->availableRoomData =  $this->reservationService->loadAvailableRoomData($this->checkInDate, $this->checkOutDate);
    }



    public function bookRoom(RoomDeal $roomDeal, array $availableRoomIds)
    {
        $this->reservationService->storeRoomToSession($roomDeal, $availableRoomIds);
        session(['booking.search' => true]);
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
